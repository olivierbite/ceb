<?php namespace Ceb\Factories;
use Ceb\Models\Institution;
use Ceb\Traits\TransactionTrait;
use Illuminate\Support\Facades\Session;

/**
 * Refund Factory
 */
class RefundFactory {
	use TransactionTrait;

	/** Variable to  hold the object that are going to be injected */
	private $institution;

	function __construct(Institution $institution) {
		$this->institution = $institution;
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
		return Session::put('refundInstitution', $institutionId);
	}
	/**
	 * get the current Refund institutions
	 * @return ID
	 */
	public function getInstitution() {
		return Session::get('refundInstitution', 1); // We assume institution 1 is dhe default one
	}
	/**
	 * Remove institution from the session
	 * @return void
	 */
	public function removeInstitution() {
		Session::forget('refundInstitution');
	}

	/**
	 * Remove all things from the session;
	 * @return [type] [description]
	 */
	public function clearAll() {
		$this->removeRefundMembers();
		$this->removeMonth();
		$this->removeInstitution();
		$this->removeDebitAccount();
		$this->removeCreditAccount();
	}

}