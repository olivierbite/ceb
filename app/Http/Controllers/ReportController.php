<?php

namespace Ceb\Http\Controllers;

use Ceb\Http\Controllers\Controller;
use Ceb\Models\Account;
use Ceb\Models\Contribution;
use Ceb\Models\Loan;
use Ceb\Models\Posting;
use Ceb\Models\User;
use Ceb\Repositories\Reports\GraphicReportRepository;
use Illuminate\Support\Facades\Log;
use Ceb\Factories\LoanFactory;

class ReportController extends Controller {
	public $report;
	function __construct(User $member) {
		$this->report = trans('report.nothing_to_show');
		$this->member = $member;
		parent::__construct();
	}

	public function index(GraphicReportRepository $report) 
	{
	    // First check if the user has the permission to do this
        if (!$this->user->hasAccess('reports.index')) {
            flash()->error(trans('Sentinel::users.noaccess'));

            return redirect()->back();
        }

        // First log 
        Log::info($this->user->email . ' is viewing reports charts index');

		$contributions = $report->getMonthlyContribution();
	    
		$loans = $report->getMontlyLoan();
		$institutions = $report->getCountMemberPerInstitution();
		$institutionsLoan = $report->getLoanByInstitution();

		return view('reports.index',compact('contributions','loans','institutions','institutionsLoan'));
	}

	/**
	 * Show saving contract letter
	 * @param  $memberId ID of the member we are reporting for
	 * @return
	 */
	public function contractSaving($memberId) {
		 // First check if the user has the permission to do this
        if (!$this->user->hasAccess('reports.contract.saving')) {
            flash()->error(trans('Sentinel::users.noaccess'));

            return redirect()->back();
        }

        // First log 
        Log::info($this->user->email . ' is viewing report contract saving');
    
		$member = $this->getMember($memberId);

		if ($member != false) {

			 $contract = view('reports.contracts_saving')->render();

			 $contract = str_replace('{contract_id}',$member->contract_id,$contract);
			 $contract = str_replace('{names}',$member->names,$contract);
			 $contract = str_replace('{adhersion_id}',$member->adhersion_id,$contract);
			 $contract = str_replace('{institution}',$member->institution_name,$contract);
			 $monthly_fees =(int)  $member->monthly_fees;
			 $contract = str_replace('{monthly_fee_in_words}',convert_number_to_words($monthly_fees),$contract);
			 $contract = str_replace('{monthly_fee}',$monthly_fees,$contract);
			 $contract = str_replace('{created_at}',$member->created_at->format('m-Y'),$contract);
			 $contract = str_replace('{today_date}',date('d-m-Y'),$contract);
			 $contract = str_replace('{names}',$member->names,$contract);
			 $contract = str_replace('{district}',$member->district,$contract);
			 $contract = str_replace('{province}',$member->province,$contract);
			 $contract = str_replace('{member_nid}',$member->member_nid,$contract);
			 $contract = str_replace('{President}',NULL,$contract);

			 $report   = $contract;
		}

		return view('layouts.printing', compact('report'));
	}
	/**
	 * Get loan contract number
	 * @param  $memberId
	 * @return mixed
	 */
	public function contractLoan(User $user,$identifier) {
		// First check if the user has the permission to do this
        if (!$this->user->hasAccess('reports.contract.loan')) {
            flash()->error(trans('Sentinel::users.noaccess'));
            return redirect()->back();
        }

        // First log 
        Log::info($this->user->email . ' is viewing report contract loan');

        // Try to find this user by his id, if it fails then 
        // Try to look for him using his adhersion number
        if(is_null($foundUser = $user->with('loans')->find($identifier)))
        {
        	// We could not find the user using his Id, we assume, the 
        	// the provided identifier is a adhersion id  let's try 
        	// to look for him/her using his adhersion number
        	
        	if (is_null($foundUser = $user->with('loans')->byAdhersion($identifier)->first())) {

        		flash()->error(trans('member.we_could_not_find_the_member_you_are_looking_for'));

        		Log::error('Unable to find a member with identifier'.$identifier);
        		
        		return redirect()->back();
        	}
        }

        // now we have found the member, let's try get his loan, otherwise we 
        // will display an error
        if (is_null($report = $foundUser->latestLoan())) {

        	    flash()->error(trans('member.member_you_are_looking_for_does_not_have_a_loan_contract'));

        		Log::error('The member you are looking for does not have a loan contract:'.$identifier);
        		
        		return redirect()->back();
        }
        
		// if the contract is empty, we assume it is not generated, let's try to generate it and save it
		if (empty($report->contract)) {
			$report->contract = generateContract($foundUser,strtolower($report->operation_type));
			$report->save();
		}
		
		$report = $report->contract;

 		return view('layouts.printing', compact('report'));
	}

	/**
	 * Get member by his ID
	 * @param  INTEGER $memberId [description]
	 * @return Model
	 */
	private function getMember($memberId) {
		 // First check if the user has the permission to do this
        if (!$this->user->hasAccess('reports.member')) {
            flash()->error(trans('Sentinel::users.noaccess'));

            return redirect()->back();
        }

        // First log 
        Log::info($this->user->email . ' is viewing report member');
    
		// Do we have the member we are looking for ?
		if (($member = $this->member->find($memberId)) == null) {
			flash()->error(trans('member.member_not_found'));
			return false;
		}
		return $member;
	}

	/**
	 * Show accounting piece reports
	 * 
	 * @param  Account $account   
	 * @param  string  $startDate 
	 * @param  string  $endDate   
	 * @return view             
	 */
	public function accountingPiece(Posting $posting, $startDate=null,$endDate=null,$excel=0)
	{
		 // First check if the user has the permission to do this
        if (!$this->user->hasAccess('reports.accounting.piece')) {
            flash()->error(trans('Sentinel::users.noaccess'));

            return redirect()->back();
        }

        // First log 
        Log::info($this->user->email . ' is viewing report of accounting piece');
    
		$postings = $posting->with('account')->betweenDates($startDate,$endDate)->get();
		$report= view('reports.accounting.piece',compact('postings'))->render();
		if ($excel==1) {
		  toExcel($report,'account-piece-report');
		}
		return view('layouts.printing', compact('report'));
	}

	/**
	 * Show ledge  reports
	 * 
	 * @param  Ceb\Models\Posting $posting   
	 * @param  string  $startDate 
	 * @param  string  $endDate   
	 * @return view             
	 */
	public function ledger(Posting $posting, $startDate=null,$endDate=null,$excel=0)
	{
		 // First check if the user has the permission to do this
        if (!$this->user->hasAccess('reports.ledger')) {
            flash()->error(trans('Sentinel::users.noaccess'));

            return redirect()->back();
        }

        // First log 
        Log::info($this->user->email . ' is viewing ledger report');
    
		$postings = $posting->with('account')->betweenDates($startDate,$endDate)->get();
		$report  = view('reports.accounting.ledger',compact('postings'))->render();
	    if ($excel==1) {
			 toExcel($report,'ledger-report');
		}
		return view('layouts.printing', compact('report'));
	}

	/**
	 * Show bilan report
	 * @param  Ceb\Models\Account $account   
	 * @param  string  $startDate 
	 * @param  string  $endDate   
	 * @return mixed             
	 */
	public function bilan(Account $account,$startDate=null,$endDate=null,$excel=0)
	{
		 // First check if the user has the permission to do this
        if (!$this->user->hasAccess('reports.bilan')) {
            flash()->error(trans('Sentinel::users.noaccess'));

            return redirect()->back();
        }

        // First log 
        Log::info($this->user->email . ' is viewing bilan report');
    
		$accounts = $account->with('postings')->get();
		$report = view('reports.accounting.bilan',compact('accounts'))->render();
		if ($excel==1) {
			 toExcel($report,'bilan-report');
		}
		return view('layouts.printing', compact('report'));
	}

	/**
	 * Show ledge  reports
	 * 
	 * @param  Ceb\Models\Posting $posting   
	 * @param  string  $startDate 
	 * @param  string  $endDate   
	 * @return view             
	 */
	public function journal(Posting $posting, $startDate=null,$endDate=null,$excel=0)
	{
		 // First check if the user has the permission to do this
        if (!$this->user->hasAccess('reports.journal')) {
            flash()->error(trans('Sentinel::users.noaccess'));

            return redirect()->back();
        }

        // First log 
        Log::info($this->user->email . ' is viewing journal report');
    
		$postings = $posting->with('account')->betweenDates($startDate,$endDate)->get();
		$report  = view('reports.accounting.journal',compact('postings'))->render();
		if ($excel==1) {
			 toExcel($report,'journal-report');
		}
		return view('layouts.printing', compact('report'));
	}

	/**
	 * Show accounts list report
	 * @param  Ceb\Models\Account $account   
	 * @param  string  $startDate 
	 * @param  string  $endDate   
	 * @return mixed             
	 */
	public function accountsList(Account $account,$excel=0)
	{
		 // First check if the user has the permission to do this
        if (!$this->user->hasAccess('reports.accounts.list')) {
            flash()->error(trans('Sentinel::users.noaccess'));

            return redirect()->back();
        }

        // First log 
        Log::info($this->user->email . ' is viewing accounts list report');
    
		$accounts = $account->all();
		$report = view('reports.accounting.accounts-list',compact('accounts'))->render();
		if ($excel==1) {
			 toExcel($report,'journal-report');
		}
		return view('layouts.printing', compact('report'));
	}


  	/**
  	 * Show member loan records
  	 * @param  numeric $memberId the ID of the member
  	 * @return view    
  	 */
    public function loanRecords(Loan $loan, $startDate=null,$endDate=null,$excel=0,$adhersionId,$excel=0)
    { 
	    // First check if the user has the permission to do this
        if (!$this->user->hasAccess('reports.loans.records')) {
            flash()->error(trans('Sentinel::users.noaccess'));

            return redirect()->back();
        }

        // First log 
        Log::info($this->user->email . ' is viewing loans records report');
    
    	$loans = $loan->with('member')->betweenDates($startDate,$endDate)->where('adhersion_id',$adhersionId)->get();
	    $report = view('reports.member.loan_records',compact('loans'))->render();
	    if ($excel==1) {
			 toExcel($report,'loanRecords-report');
		}
		return view('layouts.printing', compact('report'));
    }

    /**
     * Show this member contribution
     * @param  numeric $memberId [description]
     * @return view       
     */
    public function contributions(Contribution $contribution,$startDate=null,$endDate=null,$excel=0,$adhersionId,$excel=0)
    {
    	 // First check if the user has the permission to do this
        if (!$this->user->hasAccess('reports.contributions')) {
            flash()->error(trans('Sentinel::users.noaccess'));

            return redirect()->back();
        }

        // First log 
        Log::info($this->user->email . ' is viewing contributions report');
    
    	$contributions = $contribution->with('member')->betweenDates($startDate,$endDate)->where('adhersion_id',$adhersionId)->get();
    	$report = view('reports.member.contributions',compact('contributions'))->render();
    	if ($excel==1) {
			 toExcel($report,'contributions-report');
		}
    	return view('layouts.printing', compact('report'));
    }


    public function loans(Loan $loan,$startDate=null,$endDate=null,$status='all',$excel=0)
    {
    	 // First check if the user has the permission to do this
        if (!$this->user->hasAccess('reports.loans.status')) {
            flash()->error(trans('Sentinel::users.noaccess'));

            return redirect()->back();
        }

    	$results = $loan->with('member')->betweenDates($startDate,$endDate);
    	// if status is not all, then fetch the status
    	if (strtolower($status) !== 'all') {
	    	$results = $results->ofStatus($status);
    	}

    	$loans = $results->orderBy('operation_type','ASC')->paginate(50);

    	$report = view('reports.loans.loans',compact('loans'))->render();

    	if ($excel==1) {
			 toExcel($report,$status.'_between_'.request()->segment(3).'_and_'.request()->segment(4));
		}
    	return view('layouts.printing', compact('report'));
    }

    /**
     * Piece Disbursed Saving Report 
     * @param  string $value [description]
     * @return [type]        [description]
     */
    public function pieceDisbursedSaving()
    {
    	return 'We are still working on the piece disbursed saving';
    }

     /**
     * Piece Disbursed Account Report 
     * @param  string $value [description]
     * @return [type]        [description]
     */
    public function pieceDisbursedAccount()
    {
    	return 'We are still working on the piece disbursed account';
    }

     /**
     * Piece Disbursed Loan Report 
     * @param  string $value [description]
     * @return [type]        [description]
     */
    public function pieceDisbursedLoan()
    {
    	return 'We are still working on the piece disbursed loan';
    }
}
