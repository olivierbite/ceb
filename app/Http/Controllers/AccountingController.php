<?php

namespace Ceb\Http\Controllers;

use Ceb\Http\Controllers\Controller;
use Ceb\Http\Requests\AccountingRequest;
use Ceb\Repositories\Accounting\AccountingRepository;

class AccountingController extends Controller {

	function __construct(AccountingRepository $AccountingRepository) {
		$this->accounting = $AccountingRepository;
		parent::__construct();
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
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(AccountingRequest $request) {

		if ($transactionid = $this->accounting->complete($request->all()) != false) {			
		  return trans('accounting.transaction_is_recorded_successfully_transaction_id_is').' '.$transactionid;
		}

		return trans('general.something_unexpected_happned');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		//
	}

	private function reload() {
		return view('accounting.index');
	}
}
