<?php

namespace Ceb\Http\Controllers;

use Ceb\Factories\RefundFactory;
use Ceb\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Input;
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

		$this->refundFactory->updateMonthlyFee($adhersion_number, $monthly_fee);

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

	    $this->refundFactory->setWording(Input::get('wording'));

		// codes to complete transactions
		$transactionid = $this->refundFactory->complete();
		
		return $this->reload($transactionid);
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

		$month = $this->refundFactory->getMonth();
		$institution = $this->refundFactory->getInstitution();


		$debitAccount	= $this->refundFactory->getDebitAccount();
		$creditAccount	= $this->refundFactory->getCreditAccount();
		$members		= $this->refundFactory->getRefundMembers();
		$totalRefunds	= $this->refundFactory->getTotalRefunds();
		$refundType		= $this->refundFactory->getRefundType();

		return view('refunds.list', compact('members','institution','transactionid','refundType', 'month', 'totalRefunds', 'creditAccount', 'debitAccount'));
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
