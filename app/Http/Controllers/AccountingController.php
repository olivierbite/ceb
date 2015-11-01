<?php

namespace Ceb\Http\Controllers;

use Ceb\Http\Controllers\Controller;
use Ceb\Http\Requests\AccountingRequest;
use Ceb\Repositories\Accounting\AccountingRepository;
use Log;
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

		// First check if the user has the permission to do this
        if (!$this->user->hasAccess('accounting.view')) {
            flash()->error(trans('Sentinel::users.noaccess'));

            return redirect()->back();
        }

        // First log
        Log::info($this->user->email . ' starts to view accounting forms');
		return $this->reload();
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(AccountingRequest $request) {

		// First check if the user has the permission to do this
        if (!$this->user->hasAccess('accounting.posting')) {
            flash()->error(trans('Sentinel::users.noaccess'));

            return redirect()->back();
        }

        // First log
        Log::info($this->user->email . ' completed account posting');

		if ($transactionid = $this->accounting->complete($request->all()) != false) {			
		  return trans('accounting.transaction_is_recorded_successfully_transaction_id_is').' '.$transactionid;
		}

		return trans('general.something_unexpected_happned');
	}

	private function reload() {
		return view('accounting.index');
	}
}
