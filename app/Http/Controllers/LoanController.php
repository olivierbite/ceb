<?php
namespace Ceb\Http\Controllers;

use Ceb\Factories\LoanFactory;
use Ceb\Http\Controllers\Controller;
use Ceb\Models\Loan;
use Ceb\Models\User as Member;
use Ceb\Models\User;
use Illuminate\Support\Facades\Log;
use Input;
use Redirect;
use Session;

class LoanController extends Controller {
	protected $loanId = 0;
	protected $currentMember = null;
	protected $loanFactory;
	protected $member;
	protected $loan;

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
	// First check if the user has the permission to do this
        if (!$this->user->hasAccess('loan.index')) {
            flash()->error(trans('Sentinel::users.noaccess'));

            return redirect()->back();
        }

        // First log 
        Log::info($this->user->email . ' is viewing loan index');
		
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
	   // First check if the user has the permission to do this
        if (!$this->user->hasAccess('loan.add.member.to.loan.form')) {
            flash()->error(trans('Sentinel::users.noaccess'));

            return redirect()->back();
        }

        // First log 
        Log::info($this->user->email . ' is adding member to loan form');
		
		// Add the select member to the session
		$this->loanFactory->addMember($id);
		return $this->reload();
	}

	/**
	 * Complete loan transaction
	 * @return mixed
	 */
	public function complete() {
// First check if the user has the permission to do this
        if (!$this->user->hasAccess('loan.complete.loan.request')) {
            flash()->error(trans('Sentinel::users.noaccess'));

            return redirect()->back();
        }

        // First log 
        Log::info($this->user->email . ' is completing loan request');
	
		$memberId = $this->loanFactory->getMember()->id;

		// Make sure we update with latest form inputs
		$this->loanFactory->addLoanInput(Input::all());

        // Update accounting fields too
        $this->ajaxAccountingFeilds();

        // Complete transaction
		if ($loanId = $this->loanFactory->complete()) {
			$message = trans('loan.loan_completed');
			$this->loanId = $loanId;
			flash()->success($message);
			$this->currentMember = $memberId;
		}
		return $this->reload($this->loanId);
	}
	/**
	 * Cancel ongoing loan transaction
	 * @return mixed
	 */
	public function cancel() {
		// First check if the user has the permission to do this
        if (!$this->user->hasAccess('loan.cancel.loan.request')) {
            flash()->error(trans('Sentinel::users.noaccess'));

            return redirect()->back();
        }

        // First log 
        Log::info($this->user->email . ' is cancelling loan request');
	
		$this->loanFactory->cancel();
		$message = trans('loan.loan_cancelled');
		flash()->success($message);

		return Redirect::route('loans.index');
	}

	/**
	 * Set new cautionneur
	 */
	public function setCautionneur() {
		// First check if the user has the permission to do this
        if (!$this->user->hasAccess('loan.set.loan.cautionneur')) {
            flash()->error(trans('Sentinel::users.noaccess'));

            return redirect()->back();
        }

        // First log 
        Log::info($this->user->email . ' is setting loan cautionneur');
	
		$this->loanFactory->setCautionneur(Input::all());

		return $this->reload();
	}
	/**
	 * Remove cautionneur from the loan Factory
	 * @param  string $cautionneur
	 * @return   mixed
	 */
	public function removeCautionneur($cautionneur) {
	    // First check if the user has the permission to do this
        if (!$this->user->hasAccess('loan.remove.loan.cautionneur')) {
            flash()->error(trans('Sentinel::users.noaccess'));

            return redirect()->back();
        }

        // First log 
        Log::info($this->user->email . ' is setting loan cautionneur');
	
		$this->loanFactory->removeCautionneur($cautionneur);
		return $this->reload();
	}

	/**
	 * Reload loan page
	 * @return mixed
	 */
	private function reload($loanId = 0) {

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

		return view('loansandrepayments.index', compact('member','loanId','rightToLoan','activeLoan', 'loanInputs','operationType', 'cautionneurs', 'debitAccounts', 'creditAccounts', 'currentMemberId'));
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
   

	/**
	 * Get loan by transaction ID
	 * @param  Ceb\Models\loan   $loan          
	 * @param  $transactionId 
	 * @return 
	 */
   public function status(User $user,$transactionId)
   {
   	    // First check if the user has the permission to do this
        if (!$this->user->hasAccess('loan.check.loan.status')) {
            flash()->error(trans('Sentinel::users.noaccess'));

            return redirect()->back();
        }

        // First log 
        Log::info($this->user->email . ' is checking loan status');
	
   		$loan = $this->loan->findByTransaction($transactionId);
   		$member = $loan->member;

   	    /**
   	     * @todo add option to  mark notification as read
   	     * 
   	     */
        if ($loan == null) {
            flash()->warning(trans('loan.the_loan_you_are_looking_for_does_not_exist'));
         }
       
       return view('regularisation.index',compact('loan','member'));
   }
}
