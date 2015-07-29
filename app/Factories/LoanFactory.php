<?php
namespace Ceb\Factories;
use Ceb\Models\User;
use Illuminate\Support\Facades\Session;

/**
 * This factory helps Contribution
 */
class LoanFactory {

	function __construct(Session $session, User $member) {
		$this->session = $session;
		$this->member = $member;
	}

	/**
	 * Add member to is going to receive loan
	 * @param integer $memberId ID of the member to add to the session
	 */
	function addMember($memberId) {
		$member = $this->member->find($memberId);
		Session::put('loan_member', $member);
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
		$loanInputsData[array_keys($data)[0]] = array_values($data)[0];

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
	 * Complete current loan transaction
	 * @return bool
	 */
	public function complete() {
		/**
		 * @todo impliment loan completion
		 */
	}
	/**
	 * Cancel all activity by clearing session
	 * @return void
	 */
	function cancel() {
		$this->clearAll();
	}

	/**
	 * Clear all things in the session that are related to the loan
	 */
	private function clearAll() {
		Session::forget('loan_member');
		Session::forget('loanInputs');
	}
}