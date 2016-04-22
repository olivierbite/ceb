<?php

namespace Ceb\Http\Controllers;

use Ceb\Factories\RefundFactory;
use Ceb\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Input;
use League\Csv\Reader;
use Redirect;

class RefundController extends Controller {
	function __construct(RefundFactory $refundFactory) {
		$this->refundFactory = $refundFactory;
		parent::__construct();
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		 // First check if the user has the permission to do this
        if (!$this->user->hasAccess('refund.index')) {
            flash()->error(trans('Sentinel::users.noaccess'));

            return redirect()->back();
        }

        // First log 
        Log::info($this->user->email . ' is entering refund index');
	
		return $this->reload();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		 // First check if the user has the permission to do this
        if (!$this->user->hasAccess('refund.update')) {
            flash()->error(trans('Sentinel::users.noaccess'));

            return redirect()->back();
        }
        
        // First log 
        Log::info($this->user->email . ' is updating refund');
		// Update
		$adhersion_number = Input::get('adhersion_number');
		$monthly_fee = Input::get('monthly_fee');

		$this->refundFactory->updateRefundFee($adhersion_number, $monthly_fee);

		return $this->reload();
	}

	/**
	 * Complete refund transaction that is ongoing
	 * @return Redirect
	 */
	public function complete() {
 		// First check if the user has the permission to do this
        if (!$this->user->hasAccess('refund.complete')) {
            flash()->error(trans('Sentinel::users.noaccess'));

            return redirect()->back();
        }

        // First log 
        Log::info($this->user->email . ' is completing refund');
		if (is_null(Input::get('wording')) || empty(Input::get('wording'))) {
			flash()->error(trans('refund.you_must_write_wording_for_this_transaction'));
			return $this->reload();
		}

		// $month = $this->refundFactory->getMonth();
		// if (is_null($month)) {
		// 	flash()->error(trans('refund.please_set_month_before_you_continue'));
		// 	return $this->reload();
		// }
	    $this->refundFactory->setWording(Input::get('wording'));

		// codes to complete transactions
		$transactionid = $this->refundFactory->complete();
		
		return $this->reload($transactionid);
	}

	public function show()
	{
			return $this->reload();
	}
	/**
	 * Cancel refund transaction that is ongoing
	 * @return Redirect
	 */
	public function cancel() {
		// First check if the user has the permission to do this
        if (!$this->user->hasAccess('refund.cancel')) {
            flash()->error(trans('Sentinel::users.noaccess'));

            return redirect()->back();
        }

        // First log 
        Log::info($this->user->email . ' is cancelling refund');
		$this->refundFactory->cancel();
		flash()->success(trans('refund.successfully_cancelled'));

		return Redirect::route('refunds.index');
	}
	/**
	 * Reload the refund view
	 * @return
	 */
	private function reload($transactionid = null) {

		/** if we have any parameter passed, then set it  */
		$this->setAnyThing();

		/** Remove differences if they exists */
		$this->removeRefundsWithDifference();

		$month = $this->refundFactory->getMonth();
		$institution = $this->refundFactory->getInstitution();


		$debitAccount	= $this->refundFactory->getDebitAccount();
		$creditAccount	= $this->refundFactory->getCreditAccount();
		$members 		= $this->refundFactory->getRefundMembers();

		//Get current page form url e.g. &page=6
		$currentPage = Input::get('page', 1);

		//Create a new Laravel collection from the array data
  		$members = new Collection($members);

  		//Define how many items we want to be visible in each page
		$members = $members->forPage($currentPage,20);

		// Get page links
		$pageLinks = new Paginator($members,$members->count(),20,$currentPage);
		
		$totalRefunds				= $this->refundFactory->getTotalRefunds();
		$refundType					= $this->refundFactory->getRefundType();

		$data = [
					'members'					=> $members,
					'pageLinks'					=> $pageLinks,
					'institution'				=> $institution,
					'transactionid'				=> $transactionid,
					'refundType'				=> $refundType,
					'month'						=> $month,
					'totalRefunds'				=> $totalRefunds,
					'creditAccount'				=> $creditAccount,
					'debitAccount'				=> $debitAccount,
					'refundHasDifference'		=> !$this->refundFactory->getRefundsWithDifference()->isEmpty(),
					'uploadHasErrors'			=> !$this->refundFactory->getUploadWithErros()->isEmpty(),
				 ];

		return view('refunds.list', $data);
	}

	/**
	 * Set multiple members by uploading a csv containing their adhersion id and amount
	 * 
	 * @return [type] [description]
	 */
	public function batch()
	{
		 // First check if the user has the permission to do this
        if (!$this->user->hasAccess('refund.batch')) {
            flash()->error(trans('Sentinel::users.noaccess'));
            return redirect()->back();
        }

        // First log
        Log::info($this->user->email . ' did batch refund');

		if (!Input::hasFile('file')) {
			flash()->error('Please select a file to upload');
			return $this->reload();
		}
		 if(Input::file('file')->getClientOriginalExtension() != 'csv') {
		    Flash::error('You must upload a csv file');
		    return $this->index();
		  }

	    // checking file is valid.
	    if (Input::file('file')->isValid()) {
	       
	       $csv = Reader::createFromPath(Input::file('file'));

	       $message = '';

		   $csv->setOffset(1); //because we don't want to insert the header
	       $members = $csv->fetchAll();

           $this->refundFactory->setMember($members);
		}

		return $this->reload();
	}

	/**
	 * Export to CSV
	 * @return [type] [description]
	 */
	public function export()
	{
		// this determines if we need to export member with differences
		$this->exportRefundsWithDifference();

		// This determines if we have some numbers that has errors and help to remove them
		$this->exportRefundsWithErrors();

	}

	/**
	 * Export refunds with differences
	 * 
	 * @return void
	 */
	public function exportRefundsWithDifference()
	{
				// First check if the user has the permission to do this
        if (!$this->user->hasAccess('refund.export.refunds.with.differences')) {
            flash()->error(trans('Sentinel::users.noaccess').' - To export refund with differences');
            return redirect()->back();
        }

        // First log
        Log::info($this->user->email . ' exports contribution with differences');

		if (Input::has('export-member-with-differences') && Input::get('export-member-with-differences') == 'yes') {
			$members = $this->refundFactory->getRefundsWithDifference();
			$report = view('refunds.export_table',compact('members'))->render();
	
			toExcel($report, trans('refund.with_difference'));
		}

	}
	

	/**
	 * Export refunds with differences
	 * 
	 * @return void
	 */
	public function exportRefundsWithErrors()
	{
				// First check if the user has the permission to do this
        if (!$this->user->hasAccess('refund.export.refund.with.errors')) {
            flash()->error(trans('Sentinel::users.noaccess').' - To export refund with Errors');
            return redirect()->back();
        }

        // First log
        Log::info($this->user->email . ' exports refund with Error');

		if (Input::get('export-member-with-errors') == 'yes') {
			$members = $this->refundFactory->getUploadWithErros();
			$report = view('contributionsandsavings.export_upload_with_errors',compact('members'))->render();
			
			toExcel($report, trans('refund.with_errors'));
		}

	}

	/**
	 * Remove refunds with differences
	 * 
	 * @return void
	 */
	public function removeRefundsWithDifference()
	{
				// First check if the user has the permission to do this
        if (!$this->user->hasAccess('refund.remove.refunds.with.differences')) {
            flash()->error(trans('Sentinel::users.noaccess').' - To remove refunds with differences');
            return redirect()->back();
        }

        // First log
        Log::info($this->user->email . ' removed refunds with differences');

		if (Input::has('remove-member-with-differences') && Input::get('remove-member-with-differences') == 'yes') {
			$this->refundFactory->forgetRefundsWithDifferences();
		}
	}
    

	/**
	 * Set anything that may have been passed
	 */
	private function setAnyThing() 
	{
		$this->setInstitution();
		$this->setMonth();
		$this->setDebitAccount();
		$this->setCreditAccount();
		$this->setRefundType();
	}
	/**
	 * Set institution
	 */
	private function setInstitution() {
		// First check if the user has the permission to do this
        if (!$this->user->hasAccess('refund.set.institution')) {
            flash()->error(trans('Sentinel::users.noaccess'));

            return redirect()->back();
        }

        // First log 
        Log::info($this->user->email . ' is setting refund institution');
		// If the user has changed new institution
		if (Input::has('institution')) {
			$this->refundFactory->setInstitution(Input::get('institution'));
			$this->refundFactory->setByInsitution(Input::get('institution'));
		}
	}

	
	public function setRefundType()
	{
		if (Input::has('refund_type')) {
			$this->refundFactory->setRefundType(Input::get('refund_type'));
		}
	}	
	/**
	 * Set Debit account
	 */
	private function setDebitAccount() {
		// First check if the user has the permission to do this
        if (!$this->user->hasAccess('refund.set.debit.account')) {
            flash()->error(trans('Sentinel::users.noaccess'));

            return redirect()->back();
        }

        // First log 
        Log::info($this->user->email . ' is setting debit account for refund');
		// If we have Debit account in the url , then set it
		if (Input::has('debit_account')) {
			$this->refundFactory->setDebitAccount(Input::get('debit_account'));
		}
	}
	/**
	 * Set Credit Account
	 */
	private function setCreditAccount() {
			// First check if the user has the permission to do this
        if (!$this->user->hasAccess('refund.set.credit.account')) {
            flash()->error(trans('Sentinel::users.noaccess'));

            return redirect()->back();
        }

        // First log 
        Log::info($this->user->email . ' is setting credit account for refund');
		// If we have Credit account in the url then set credit account
		if (Input::has('credit_account')) {
			$this->refundFactory->setCreditAccount(Input::get('credit_account'));
		}
	}
	/**
	 * Set Month
	 */
	private function setMonth() {
	    // First check if the user has the permission to do this
        if (!$this->user->hasAccess('refund.set.month')) {
            flash()->error(trans('Sentinel::users.noaccess'));

            return redirect()->back();
        }

        // First log 
        Log::info($this->user->email . ' is setting month for refund');
		// If we have month in the parameters set it
		if (Input::has('month')) {
			$this->refundFactory->setMonth(Input::get('month'));
		}
	}

	/**
	 * Remove a member from the current contribution session
	 * 
	 * @param   $adhersion_id 
	 * @return  mixed
	 */
	public function removeMember($adhersion_id)
	{

	   // First check if the user has the permission to do this
        if (!$this->user->hasAccess('refund.remove.member')) {
            flash()->error(trans('Sentinel::users.noaccess'));
            return redirect()->back();
        }

        // First log
        Log::info($this->user->email . ' removed member contribution');
    	
		$this->refundFactory->removeMember($adhersion_id);
		return $this->reload();
	}
}
