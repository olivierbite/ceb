<?php
namespace Ceb\Factories;
use Ceb\Models\Loan;
use Ceb\Models\User;
use Ceb\Traits\TransactionTrait;
use Datetime;
use DB;
use Illuminate\Support\Facades\Session;
use Sentry;

/**
 * This factory helps Contribution
 */
class LoanFactory {

	use TransactionTrait;

	function __construct(Session $session, User $member, Loan $loan, Sentry $user) {
		$this->session = $session;
		$this->member = $member;
		$this->loan = $loan;
		$this->user = $user;
	}

	/**
	 * Add member to is going to receive loan
	 * @param integer $memberId ID of the member to add to the session
	 */
	function addMember($memberId) {
		$member = $this->member->find($memberId);

		// Detect if this member is not more than 6 months
		// as per de definition of CEB
		if (!$this->isEligeable($member)) {
			flash()->error(trans('loan.error_member_has_to_be_at_least_6_months_in_ceb'));
			return false;
		}

		Session::put('loan_member', $member);
		$this->updateCautionneur();
	}

	/**
	 * Get member who is going to receive the loan
	 * @return  get member information that are currently in the session
	 */
	function getMember() {
		return Session::get('loan_member', new $this->member);
	}

	/**
	 * Add loan input in the session
	 * @param  array  $data containing loan input data
	 * @return void
	 */
	public function addLoanInput(array $data) {
		// First get the existing loan inputs
		$loanInputsData = $this->getLoanInputs();

		// Add the submitted one before saving
		foreach ($data as $key => $value) {
			$loanInputsData[$key] = $value;
		}

		Session::put('loanInputs', $loanInputsData);
	}
	/**
	 * Get current loan input fields
	 * @return array
	 */
	public function getLoanInputs() {
		return Session::get('loanInputs', []);
	}
	/**
	 * Set new cautionneur
	 * @param array $cautionneur
	 */
	public function setCautionneur(array $cautionneur) {
		$arrayKey = array_keys($cautionneur)[0];
		$cautionneurId = array_values($cautionneur)[0];
		$cautionneurs = $this->getCautionneurs();

		$cautionneurs[$arrayKey] = $this->member->findByAdhersion($cautionneurId);

		if ($cautionneurs[$arrayKey] == null) {
			flash()->error(trans('loan.adhersion_number_you_are_looking_for_cannot_be_found'));
			// Nothing to do here
			return false;
		}
		// Make sure the selected cautionneur is not
		// same as the member
		if ($cautionneurs[$arrayKey]->id == $this->getMember()->id) {
			flash()->error(trans('loan.cautionneur_should_not_be_the_same_as_the_member_requesting_loan'));
			return false;
		}
		flash()->success(trans('loan.cautionneur_has_been_added_successfully'));
		Session::put('cautionneurs', $cautionneurs);
	}

	/**
	 * Remove cautionneur from the sessoin
	 * @param  string $cautionneur
	 * @return mixed
	 */
	public function removeCautionneur($cautionneur) {
		$cautionneurs = $this->getCautionneurs();
		// Remove the cautionneur
		unset($cautionneurs[$cautionneur]);
		flash()->success(trans('loan.cautionneur_removed_successfully'));
		Session::put('cautionneurs', $cautionneurs);
	}

	/**
	 * Make sure cautionneur are not same as the
	 * Selected member
	 *
	 */
	public function updateCautionneur() {
		$cautionneurs = $this->getCautionneurs();

		foreach ($cautionneurs as $key => $cautionneur) {
			if ($cautionneur->id == $this->getMember()->id) {
				unset($cautionneurs[$key]);
			}
		}
		Session::put('cautionneurs', $cautionneurs);
	}
	/**
	 * Get cautionneurs set
	 * @return  array of cautionneur
	 */
	public function getCautionneurs() {
		return Session::get('cautionneurs', []);
	}

	/**
	 * Setting the debit accounts and their value
	 *
	 * @param void
	 */
	public function setDebitsAccounts(array $debits, array $amounts) {
		Session::put('debitaccounts', $this->accountAmount($debits, $amounts));
	}
	/**
	 * Get the debit accounts
	 * @return array of debit account and their amount
	 */
	public function getDebitAccounts() {
		return Session::get('debitaccounts', []);
	}

	/**
	 * Setting Credit accounts in the sessions
	 * @param array $credits contains the IDs of the accounts to be credited
	 * @param array $amounts contains the amount of money to be credited per account
	 *
	 * @return void
	 */
	public function setCreditAccounts(array $credits, array $amounts) {
		Session::put('creditaccounts', $this->accountAmount($credits, $amounts));
	}

	/**
	 * Get the credit accounts and their correspondent amount
	 * @return array of the credit account and their correspondent amount
	 */
	public function getCreditAccounts() {
		return Session::get('creditaccounts', []);
	}

	/**
	 * Remove credit accounts from the sessoin
	 * @return void
	 */
	public function removeCreditAccounts() {
		Session::forget('creditaccounts');
	}
	/**
	 * Remote debit accounts and their amount from the session
	 * @return void
	 */
	public function removeDebitAccounts() {
		Session::forget('debitaccounts');
	}

	/**
	 * Check if we are not debitting and creditng same account
	 * @param  array  $debitaccounts
	 * @return
	 */
	public function validateAccounts(array $debitaccounts) {
		# code...
	}

	/**
	 * Get the operation type of this loan
	 * @return string the operation type of this loan
	 */
	public function getOperationType() {
		$inputs = $this->getLoanInputs();
	}
	/**
	 * Mapping the accounts with their amount
	 * @param array $accounts accounts IDs
	 * @param array $amounts  accounts Amount
	 */
	public function accountAmount(array $accounts, array $amounts) {
		$newData = [];
		foreach ($accounts as $key => $value) {
			$newData[$value['value']] = $amounts[$key]['value'];
		}
		return $newData;
	}

	/**
	 * Complete current loan transaction
	 * @return bool
	 */
	public function complete() {
		// 1. First record the loan
		$transactionId = $this->getTransactionId();

		// Start saving if something fails cancel everything
		Db::beginTransaction();

		// 1. Save loans first
		$saveLoan = $this->saveLoan($transactionId);

		// 2. Debit and credit accounts
		$savePosting = $this->savePostings($transactionId);

		// Rollback the transaction via if one of the insert fails
		if (!$saveLoan || !$savePosting) {
			DB::rollBack();
			return false;
		}

		// Lastly, Let's commit a transaction since we reached here
		DB::commit();
		return true;

	}

	/**
	 * Save loan in postings for the accounting purpose
	 * @param  string $transactionid unique transactionId
	 * @return bool
	 */
	public function saveLoan($transactionid) {

		dd($transactionid);

		// First refresh the data
		$this->calculateLoanDetails();

		$inputs = $this->getLoanInputs();
		$member = $this->getMember();

		$inputs['transactionid'] = $transactionid;
		// Prepare information to be saved in the database
		$data['loan_contract'] = $this->getContributionContractNumber();
		$data['adhersion_id'] = $member->adhersion_id;
		$data['movement_nature'] = 'Test movement_nature';
		$data['operation_type'] = $this->getOperationType();
		$data['letter_date'] = $inputs['letter_date'];
		$data['right_to_loan'] = $inputs['right_to_loan'];
		$data['wished_amount'] = $inputs['wished_amount'];
		$data['loan_to_repay'] = $inputs['loan_to_repay'];
		$data['interests'] = $inputs['interests'];
		$data['InteretsPU'] = 0;
		$data['amount_received'] = $inputs['amount_received'];
		$data['tranches_number'] = $inputs['tranches_number'];
		$data['monthly_fees'] = $inputs['monthly_fees'];
		$data['cheque_number'] = $inputs['cheque_number'];
		$data['bank_id'] = $inputs['bank_id'];
		$data['security_type'] = null;
		$data['cautionneur1'] = null;
		$data['cautionneur2'] = null;
		$data['average_refund'] = 0;
		$data['amount_refounded'] = 0;
		$data['comment'] = 'No comment so far';
		$data['special_loan_contract_number'] = null;
		$data['remaining_tranches'] = $inputs['tranches_number'];
		$data['special_loan_tranches'] = 0;
		$data['special_loan_interests'] = 0;
		$data['special_loan_amount_to_receive'] = 0;
		$data['user_id'] = $this->user->getUser()->id;
		return $this->loan->create($inputs);
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
		$posting['account_id'] = $this->contributionFactory->getDebitAccount();
		$posting['journal_id'] = 1; // We assume per default we are using journal 1
		$posting['asset_type'] = null;
		$posting['amount'] = $this->contributionFactory->total();
		$posting['user_id'] = Sentry::getUser()->id;
		$posting['account_period'] = date('Y');
		$posting['transaction_type'] = 'Debit';

		// Try to post the debit before crediting another account
		$debiting = Posting::create($posting);

		// Change few data for crediting
		// Then try to credit the account too
		$posting['transaction_type'] = 'Credit';
		$posting['account_id'] = $this->contributionFactory->getCreditAccount();

		$crediting = Posting::create($posting);

		if (!$debiting || !$crediting) {
			return false;
		}
		// Ouf time to go to bed now
		return true;
	}

	/**
	 * Get loan interest
	 * @return float
	 */
	public function getInterestRate() {
		$numberOfInstallment = $this->getLoanInputs()['tranches_number'];

		if ($numberOfInstallment > 0 && $numberOfInstallment <= 12) {return 3.4;}
		if ($numberOfInstallment > 12 && $numberOfInstallment <= 24) {return 3.6;}
		if ($numberOfInstallment > 24 && $numberOfInstallment <= 36) {return 4.1;}
		if ($numberOfInstallment > 36 && $numberOfInstallment <= 48) {return 4.3;}
	}
	/**
	 * Calculate loan details
	 * @return mixed
	 */
	public function calculateLoanDetails() {
		$loanDetails = $this->getLoanInputs();
		$loanToRepay = $loanDetails['loan_to_repay'];
		$interestRate = $this->getInterestRate();
		$numberOfInstallment = $loanDetails['tranches_number'];

		// Interest formular
		// The formular to calculate interests at ceb is as following
		// I =  P *(TI * N)
		//     ------------
		//     1200 + (TI*N)
		//
		// Where :   I : Interest
		//           P : Amount to Repay
		//           TI: Interest Rate
		//           N : Montly payment
		// LoanToRepay * (InterestRate*NumberOfInstallment) / 1200 +(InterestRate*NumberOfInstallment)

		$interests = ($loanToRepay * ($interestRate * $numberOfInstallment)) / (1200 + ($interestRate * $numberOfInstallment));
		$netToReceive = $loanToRepay - $interests;

		// Update fields
		$this->addLoanInput(['right_to_loan' => round(($loanToRepay * 2.5), 2)]);
		$this->addLoanInput(['interests' => round($interests, 2)]);
		$this->addLoanInput(['net_to_receive' => round($netToReceive, 2)]);
		$this->addLoanInput(['monthly_fees' => round(($netToReceive / $numberOfInstallment), 2)]);
		$this->addLoanInput(['adhersion_id' => $this->getMember()->adhersion_id]);

		// Add cautionneur
		foreach ($this->getCautionneurs() as $key => $value) {
			$this->addLoanInput[$key] = $value->id;
		}

		// If loan to pay is less or equal to the
		// Contributions then hide the caution section

	}

	private function saveAccuntingInformation() {
		# code...
	}

	/**
	 * Cancel all activity by clearing session
	 * @return void
	 */
	public function cancel() {
		$this->clearAll();
	}

	/**
	 * Check if this person we are trying to give
	 * Loan is eligeable for it
	 * @param  User    $user member Object
	 * @return boolean    determine if he is eligeable or not
	 */
	private function isEligeable(User $user) {
		// Check if the member has an age
		// of 6 months in CEB
		$dateDifference = date_diff($user->created_at, new Datetime);
		// Get the difference in months
		$interval = $dateDifference->format('%m');

		// Check if the months are at least 6 configured to 1 for the
		// Development purpose
		return $interval >= 1;
	}
	/**
	 * Clear all things in the session that are related to the loan
	 */
	private function clearAll() {
		Session::forget('loan_member');
		Session::forget('loanInputs');
		Session::forget('cautionneurs');
		Session::forget('creditaccounts');
		Session::forget('debitaccounts');
	}
}