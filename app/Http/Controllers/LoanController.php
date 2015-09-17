<?php

namespace Ceb\Http\Controllers;
use Ceb\Factories\LoanFactory;
use Ceb\Http\Controllers\Controller;
use Input;
use Redirect;
use Ceb\Models\User as Member;
use Ceb\Models\Loan;
use Session;

class LoanController extends Controller {
	protected $completionStatus = false;
	protected $currentMember = null;
	protected $loanFactory;
	protected $loan;
	protected $member;
	function __construct(LoanFactory $loanFactory,Member $member,Loan $loan) {
		$this->member = $member;
		$this->loanFactory = $loanFactory;
		$this->loan = $loan;
		parent::__construct();
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		if (Input::has('operation_type')) {
			$this->loanFactory->addLoanInput(['operation_type' =>Input::get('operation_type')]);
		}
		return $this->reload();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function selectMember($id) {

		// Add the select member to the session
		$this->loanFactory->addMember($id);
		return $this->reload();
	}

	/**
	 * Complete loan transaction
	 * @return mixed
	 */
	public function complete() {

		$memberId = $this->loanFactory->getMember()->id;

		// Make sure we update with latest form inputs
		$this->loanFactory->addLoanInput(Input::all());
        // Update accounting fields too
        $this->ajaxAccountingFeilds();

        // Complete transaction
		if ($this->loanFactory->complete()) {
			$message = trans('loan.loan_completed');
			$this->completionStatus = true;
			flash()->success($message);
			$this->currentMember = $memberId;
		}
		return $this->reload($this->completionStatus);
	}
	/**
	 * Cancel ongoing loan transaction
	 * @return mixed
	 */
	public function cancel() {
		$this->loanFactory->cancel();
		$message = trans('loan.loan_cancelled');
		flash()->success($message);

		return Redirect::route('loans.index');
	}

	/**
	 * Set new cautionneur
	 */
	public function setCautionneur() {
		$this->loanFactory->setCautionneur(Input::all());

		return $this->reload();
	}
	/**
	 * Remove cautionneur from the loan Factory
	 * @param  string $cautionneur
	 * @return   mixed
	 */
	public function removeCautionneur($cautionneur) {
		$this->loanFactory->removeCautionneur($cautionneur);
		return $this->reload();
	}

	/**
	 * Reload loan page
	 * @return mixed
	 */
	private function reload($completionStatus = false) {

		$member = $this->loanFactory->getMember();
		$loanInputs = $this->loanFactory->getLoanInputs();
		$loanInputs['operation_type'] = isset($loanInputs['operation_type']) ? $loanInputs['operation_type'] : 'ordinary_loan';

		$creditAccounts = $this->loanFactory->getCreditAccounts();
		$debitAccounts = $this->loanFactory->getDebitAccounts();
		$cautionneurs = $this->loanFactory->getCautionneurs();
		$operationType = $this->loanFactory->getOperationType();
		$currentMemberId = $this->currentMember;
		$activeLoan = $this->loan;
		$rightToLoan = 0;

		if ($member->exists) {
			$rightToLoan = $member->rightToLoan();
		}

		if ($member->hasActiveLoan()) {// Member has active loan
			 if ($loanInputs['operation_type'] == 'special_loan') {
			    $rightToLoan = 100000;
			 }		 
		 $activeLoan = $member->latestLoan();
		}

		return view('loansandrepayments.index', compact('member','rightToLoan','activeLoan', 'loanInputs','operationType', 'cautionneurs', 'debitAccounts', 'creditAccounts', 'currentMemberId'));
	}

	/**
	 * THIS SECTION HAS THE AJAX FUNCTIONS THAT ARE CALLED BY THE
	 * AJAX API ONLY
	 */
	/**
	 * Update a loan field
	 * @return  void
	 */
	public function ajaxFieldUpdate() {
		$this->loanFactory->addLoanInput(Input::all());

		$this->loanFactory->calculateLoanDetails();
	}

	/**
	 * Stores in the session the debit accounts ids and credit accounts IDs
	 * @return void
	 */
	public function ajaxAccountingFeilds() {
		// Let's try to store what is submitted
		// in the session
		// If we have debit accounts in the submission
		// then try to set it in the session
		if (Input::has('debitAccounts')) {
			$this->loanFactory->setDebitsAccounts(Input::get('debitAccounts'), Input::get('debitAmounts'));
		}

		if (Input::has('creditAccounts')) {
			$this->loanFactory->setCreditAccounts(Input::get('creditAccounts'), Input::get('creditAmounts'));
		}
	}

}
