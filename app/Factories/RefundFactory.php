<?php namespace Ceb\Factories;
use Ceb\Models\Institution;
use Ceb\Models\Posting;
use Ceb\Models\Refund;
use Ceb\Traits\TransactionTrait;
use DB;
use Illuminate\Support\Facades\Session;
use Sentry;
use Ceb\Models\User;

/**
 * Refund Factory
 */
class RefundFactory {
	use TransactionTrait;

	/** Variable to  hold the object that are going to be injected */
	private $institution;

	function __construct(Institution $institution, Refund $refund, Posting $posting,User $member) {
		$this->institution = $institution;
		$this->refund = $refund;
		$this->posting = $posting;
		$this->member = $member;
	}

	/**
	 * Set members by institutions
	 * @param integer $institutionId
	 */
	public function setByInsitution($institutionId = 1) {
		// Do we have some savings ongoing ?
		if (Session::has('refundMembers')) {
			// We have things in the session
			// Clear the session befor continuing
			$this->clearAll();
		}
		// Get the institution by its id
		$members = $this->institution->find((int) $institutionId)->membersWithLoan();
		if (!is_array($members)) {
			$members = [];
		}

		$this->setRefundMembers($members);
	}

	/**
	 * Set members
	 * @param integer $memberId
	 *
	 * @return bool
	 */
	public function setMember($memberId)
	{
		$member = $this->member->findOrFail($memberId);

		if (!$member->hasActiveLoan()) {
			flash()->error(trans('member.this_member_doesnot_have_active_loan'));
			return false;
		}
        // Make sure amount is numeric
        $member->monthly_fee = (int) $member->monthly_fee;
        
		$members[] = $member;
		$this->setRefundMembers($members);
		return true;
	}

	/**
	 * Update a single monthly contribution for a given uses
	 * @param  [type] $adhersion_number [description]
	 * @param  [type] $newValue         [description]
	 * @return [type]                   [description]
	 */
	public function updateMonthlyFee($adhersion_number, $newMontlyFee) {
		// First get what is in the session now
		$data = $this->getRefundMembers();
		// in (PHP 5 >= 5.5.0) you don't have to write your own function to search through a multi dimensional array
		$key = $this->searchAdhersionKey($adhersion_number, $data);

		// An array can have index 0 that's why we check if it's not strictly false
		if ($key !== false) {
			$data[$key]['monthly_fee'] = $newMontlyFee;
		}
		// Now we are ready to go
		return $this->setRefundMembers($data);
	}

	/**
	 * Complete current transactions in refund
	 *
	 * @return  bool
	 */
	public function complete() {

		$transactionId = $this->getTransactionId(); // Generating unique transactionid

		// Start saving if something fails cancel everything
		DB::beginTransaction();

		$saveRefund = $this->saveRefund($transactionId);

		$savePosting = $this->savePostings($transactionId);
		// Rollback the transaction via if one of the insert fails
		if (!$saveRefund || !$savePosting) {
			DB::rollBack();

			flash()->error(trans('refund.error_occured_during_the_processes_of_registering_refund_please_try_again'));
			return false;
		}

		// Lastly, Let's commit a transaction since we reached here
		DB::commit();
		// Remove everything from the session
		$this->clearAll();
		flash()->success(trans('refund.refun_transaction_sucessfully_registered'));
		return true;

	}

	/**
	 * Saving refunds in the database
	 * @param  [type] $transactionId [description]
	 * @return [type]                [description]
	 */
	private function saveRefund($transactionId) {
		# Get data in the factory
		$refundMembers = $this->getRefundMembers();
		$month = $this->getMonth();
		$contractNumber = $this->getContributionContractNumber();
		$month = $this->getMonth();

		foreach ($refundMembers as $refundMember) {
			// dd($refundMember->latestLoan());
			$refund['adhersion_id'] = $refundMember->adhersion_id;
			$refund['contract_number'] = $refundMember->latestLoan()->loan_contract;
			$refund['month'] = $this->getMonth();
			$refund['amount'] = $refundMember->loanMonthlyFees();
			$refund['tranche_number'] = $refundMember->latestLoan()->tranches_number;
			$refund['transaction_id'] = $transactionId;
			$refund['member_id'] = $refundMember->id;
			$refund['user_id'] = Sentry::getUser()->id;
			$refund['loan_id'] = $refundMember->latestLoan()->id;
			$refund['wording'] = $this->getWording();

			// dd($refund);
			# try to save if it doesn't work then
			# exist the loop
			$newRefund = $this->refund->create($refund);
			if (!$newRefund) {
				return false;
			}
		}

		return true;
	}

	/**
	 * Save posting to the database
	 * @param  STRING $transactionId UNIQUE TRANSACTIONID
	 * @return bool
	 */
	private function savePostings($transactionId) {

		// First prepare data to use for the debit account
		// Once are have debited(deducted data) then we can
		// Credit the account to be credited
		$posting['transactionid'] = $transactionId;
		$posting['account_id'] = $this->getDebitAccount();
		$posting['journal_id'] = 1; // We assume per default we are using journal 1
		$posting['asset_type'] = null;
		$posting['amount'] = $this->getTotalRefunds();
		$posting['user_id'] = Sentry::getUser()->id;
		$posting['account_period'] = date('Y');
		$posting['transaction_type'] = 'Debit';

		// Try to post the debit before crediting another account
		$debiting = $this->posting->create($posting);

		// Change few data for crediting
		// Then try to credit the account too
		$posting['transaction_type'] = 'Credit';
		$posting['account_id'] = $this->getCreditAccount();

		$crediting = $this->posting->create($posting);

		if (!$debiting || !$crediting) {
			return false;
		}
		// Ouf time to go to bed now
		return true;
	}
	/**
	 * Get Total Refunds fees
	 * @return decimal montly fees
	 */
	public function getTotalRefunds() {
		$sum = 0;
		$members = $this->getRefundMembers();
		foreach ($members as $member) {
			$sum += $member->loanMonthlyFees();
		}
		return $sum;
	}
	/**
	 * Set members who are about to refund
	 * @param array $members
	 */
	public function setRefundMembers(array $members) {
		Session::put('refundMembers', $members);
	}
	/**
	 * Get members who are refunding
	 * @return array
	 */
	public function getRefundMembers() {
		return Session::get('refundMembers', []);
	}

	/**
	 * Remove members who are refunding from the session
	 * @return void
	 */
	public function removeRefundMembers() {
		Session::forget('refundMembers');
	}
	/**
	 * Set Month of transactions
	 * @param string composed by  $month and Year
	 */
	public function setMonth($month) {
		Session::put('refundMonth', $month);
	}
	/**
	 * Get the stoed month in the session
	 * @return [type] [description]
	 */
	public function getMonth() {
		return Session::get('refundMonth', date('mY'));
	}

	/**
	 * Remove refund month from the session
	 * @return void
	 */
	public function removeMonth() {
		Session::forget('refundMonth');
	}
	/**
	 * Set debit account ID
	 * @param integer $accountid
	 */
	public function setDebitAccount($accountid) {
		Session::put('refundDebitAccount', $accountid);
	}
	/**
	 * Set Credit account
	 * @param  $accountid
	 */
	public function setCreditAccount($accountid) {
		Session::put('refundCreditAccount', $accountid);
	}
	/**
	 * get Debit account
	 * @return numeric account ID
	 */
	public function getDebitAccount() {
		return Session::get('refundDebitAccount', 1);
	}
	/**
	 * Get Credit Account
	 * @return numeric unique
	 */
	public function getCreditAccount() {
		return Session::get('refundCreditAccount', 2);
	}
	/**
	 * Remove debit account
	 * @return void
	 */
	public function removeDebitAccount() {
		Session::forget('refundDebitAccount');
	}
	/**
	 * Remove credit account from the session
	 * @return void
	 */
	public function removeCreditAccount() {
		Session::forget('refundCreditAccount');
	}
	/**
	 * Set the institution
	 * @param mixed $institutionId
	 */
	public function setInstitution($institutionId) {
		 Session::put('refundInstitution', $institutionId);
	}
	/**
	 * get the current Refund institutions
	 * @return ID
	 */
	public function getInstitution() {
		return Session::get('refundInstitution'); // We assume institution 1 is dhe default one
	}
	/**
	 * Remove institution from the session
	 * @return void
	 */
	public function removeInstitution() {
		Session::forget('refundInstitution');
	}
/**
	 * Set wording for the current contribution
	 * 
	 * @param void
	 */
	public function setWording($wording)
	{
		Session::put('refund_wording', $wording);
	}

	/**
	 * Get wording for current contributionsession
	 * 
	 * @return string
	 */
	public function getWording()
	{
		return Session::get('refund_wording', null);
	}

	/**
	 * Remove wording from the session
	 * @return [type] [description]
	 */
	public function forgetWording()
	{
		Session::forget('refund_wording');
	}
	/**
	 * Cancel transaction that is ongoin
	 * @return  void
	 */
	public function cancel() {
		$this->clearAll();
	}

	/**
	 * Remove all things from the session;
	 * @return [type] [description]
	 */
	private function clearAll() {
		$this->removeRefundMembers();
		$this->removeMonth();
		$this->removeInstitution();
		$this->removeDebitAccount();
		$this->removeCreditAccount();
		$this->forgetWording();
	}

}