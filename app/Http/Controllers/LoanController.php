<?php

namespace Ceb\Http\Controllers;
use Ceb\Factories\LoanFactory;
use Ceb\Http\Controllers\Controller;
use Input;

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

	/** Complete loan */
	public function complete() {
		$message = trans('loan.loan_completed');
		flash()->success($message);
		return $this->reload();
	}

	public function cancel() {
		$this->loanFactory->cancel();
		$message = trans('loan.loan_cancelled');
		flash()->success($message);

		return $this->reload();
	}

	private function reload() {
		$member = $this->loanFactory->getMember();
		return view('loansandrepayments.index', compact('member'));
	}
}
