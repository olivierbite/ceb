<?php

namespace Ceb\Http\Controllers;

use Ceb\Factories\RefundFactory;
use Ceb\Http\Controllers\Controller;
use Input;

class RefundController extends Controller {
	function __construct(RefundFactory $refundFactory) {
		$this->refundFactory = $refundFactory;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		return $this->reload();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		// Update
		$adhersion_number = Input::get('adhersion_number');
		$monthly_fee = Input::get('monthly_fee');

		$this->refundFactory->updateMonthlyFee($adhersion_number, $monthly_fee);

		return $this->reload();
	}
	/**
	 * Reload the refund view
	 * @return
	 */
	private function reload() {

		/** if we have any parameter passed, then set it  */
		$this->setAnyThing();

		$month = $this->refundFactory->getMonth();
		$institution = $this->refundFactory->getInstitution();
		$debitAccount = $this->refundFactory->getDebitAccount();
		$creditAccount = $this->refundFactory->getCreditAccount();
		$members = $this->refundFactory->getRefundMembers();
		$totalRefunds = $this->refundFactory->getTotalRefunds();

		return view('refunds.list', compact('members', 'month', 'totalRefunds', 'creditAccount', 'debitAccount'));
	}

	/**
	 * Set anything that may have been passed
	 */
	private function setAnyThing() {
		$this->setInstitution();
		$this->setMonth();
		$this->setDebitAccount();
		$this->setCreditAccount();
	}
	/**
	 * Set institution
	 */
	private function setInstitution() {
		// If the user has changed new institution
		if (Input::has('institution')) {
			$this->refundFactory->setByInsitution(Input::get('institution'));
			$this->refundFactory->setByInsitution(Input::get('institution'));
		}
	}
	/**
	 * Set Debit account
	 */
	private function setDebitAccount() {
		// If we have Debit account in the url , then set it
		if (Input::has('debit_account')) {
			$this->refundFactory->setDebitAccount(Input::get('debit_account'));
		}
	}
	/**
	 * Set Credit Account
	 */
	private function setCreditAccount() {
		// If we have Credit account in the url then set credit account
		if (Input::has('credit_account')) {
			$this->refundFactory->setCreditAccount(Input::get('credit_account'));
		}
	}
	/**
	 * Set Month
	 */
	private function setMonth() {
		// If we have month in the parameters set it
		if (Input::has('month')) {
			$this->refundFactory->setMonth(Input::get('month'));
		}
	}
}
