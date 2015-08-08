<?php

namespace Ceb\Http\Controllers;
use Ceb\Factories\LoanFactory;
use Ceb\Http\Controllers\Controller;
use Input;
use Redirect;
use Session;

class LoanController extends Controller {

	protected $loanFactory;
	function __construct(LoanFactory $loanFactory) {
		$this->loanFactory = $loanFactory;
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
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		dd(Input::all());
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

		// dd(Session::all());
		$this->loanFactory->complete();
		$message = trans('loan.loan_completed');
		flash()->success($message);
		return $this->reload();
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
	private function reload() {
		$member = $this->loanFactory->getMember();
		$loanInputs = $this->loanFactory->getLoanInputs();
		$creditAccounts = $this->loanFactory->getCreditAccounts();
		// dd($creditAccounts);
		$debitAccounts = $this->loanFactory->getDebitAccounts();

		$cautionneurs = $this->loanFactory->getCautionneurs();

		return view('loansandrepayments.index', compact('member', 'loanInputs', 'cautionneurs', 'debitAccounts', 'creditAccounts'));
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
	public function ajaxAccountingFeieds() {
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
