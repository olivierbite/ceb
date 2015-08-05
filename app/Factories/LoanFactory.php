<?php
namespace Ceb\Factories;
use Ceb\Models\Loan;
use Ceb\Models\User;
use Ceb\Traits\TransactionTrait;
use Datetime;
use Illuminate\Support\Facades\Session;

/**
 * This factory helps Contribution
 */
class LoanFactory {

	use TransactionTrait;

	function __construct(Session $session, User $member, Loan $loan) {
		$this->session = $session;
		$this->member = $member;
		$this->loan = $loan;
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
	 * Complete current loan transaction
	 * @return bool
	 */
	public function complete() {
		// 1. First record the loan
		$transactionid = $this->getTransactionId();
		$this->saveLoan($transactionid);
		// 2. Debit and credit accounts
	}

	public function saveLoan($transactionid) {
		// First refresh the data
		$this->calculateLoanDetails();
		$inputs = $this->getLoanInputs();
		$inputs['transactionid'] = $transactionid;
		$this->loan->create($inputs);
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
	}
}