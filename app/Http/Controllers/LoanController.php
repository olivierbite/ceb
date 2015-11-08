<?php
namespace Ceb\Http\Controllers;

use Ceb\Factories\LoanFactory;
use Ceb\Http\Controllers\Controller;
use Ceb\Http\Requests\CompleteLoanRequest;
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
	 * @param integer $loanId determines if the loan is completed or
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
	public function complete(CompleteLoanRequest $request) {
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

        // Only complete transaction when someone does a post request
        if ($request->isMethod('post')) {
	        // Complete transaction
			if ($loanId = $this->loanFactory->complete()) {
				$message = trans('loan.loan_completed');
				$this->loanId = $loanId;
				flash()->success($message);
				$this->currentMember = $memberId;

				// If this user doesn't have right to view the contract
				// Then show him an error
		        if (!$this->user->hasAccess('reports.contract.loan')) {
		            flash()->warning(trans('loan.loan_completed_but_we_didnot_show_you_contract_because_you_do_not_have_the_right_to_view_it'));
		            $this->loanId = 0;
		        }
			}
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

		$this->loanFactory->setBondedAmount();
	}
   

	/**
	 * Get loan by transaction ID
	 * @param  Ceb\Models\loan   $loan          
	 * @param  $transactionId 
	 * @return 
	 */
   public function process($loanId,$toSetstatus)
   {
   	    // First check if the user has the permission to do this
        if (!$this->user->hasAccess('loan.check.loan.status')) {
            flash()->error(trans('Sentinel::users.noaccess'));

            return redirect()->back();
        }

        /** we can only allow to reject or approve a loan */
        if ((strtolower($toSetstatus) !== 'rejected') && (strtolower($toSetstatus) !== 'approved')) {
        	flash()->error(trans('loan.loan_can_either_be_approved_or_rejected'));
        	return redirect()->back();
        }

        // First log 
        Log::info($this->user->email . ' is checking loan status');	

   		$loan = $this->loan->pending()->find($loanId);

   		if (is_null($loan)) {
   			flash()->worning(trans('loan.we_could_not_find_the_loan_you_are_looking_for'));
   			return redirect()->back();
   		}

  		$loan->status = strtolower($toSetstatus);
  		
  		$isWellUpdated = $loan->save();

	  	flash()->success(trans('loan.loan_with_transaction_id_'.$loan->transactionid.'_has_been_'.$loan->status));

  		if(($isWellUpdated == true) && (strtolower($toSetstatus) === 'approved'))
  		{
	  		/**
	   	     * @todo add option to  mark notification as read
	   	     * 
	   	     */
	  		return redirect()->route('reports.members.contracts.loan',['loanId'=>$loan->member->id]);
  		}

  		return redirect()->route('loan.pending');
   	    
   }


   public function getPending($transactionId = null)
   {
   	    // First check if the user has the permission to do this
        if (!$this->user->hasAccess('loan.can.approve.loan')) {
            flash()->error(trans('Sentinel::users.noaccess'));

            return redirect()->back();
        }

        // First log 
        Log::info($this->user->email . ' is viewing pending loan');

        if (!is_null($transactionId)) {
        	// we are looking for a special loan, let's grab it  	
	   		$loans = $this->loan->pending()->findByTransaction($transactionId)->paginate(20);;
        }
        else
        {
	   		$loans = $this->loan->with('member.institution')->pending()->paginate(20);
        }

   	    return view('reports.loans.loans',compact('loans'));

   }
}
