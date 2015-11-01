<?php

namespace Ceb\Http\Controllers;

use Ceb\Http\Controllers\Controller;
use Ceb\Models\Account;
use Ceb\Models\Contribution;
use Ceb\Models\Loan;
use Ceb\Models\Posting;
use Ceb\Models\User;
use Ceb\Repositories\Reports\GraphicReportRepository;

class ReportController extends Controller {
	public $report;
	function __construct(User $member) {
		$this->report = trans('report.nothing_to_show');
		$this->member = $member;
		parent::__construct();
	}

	public function index(GraphicReportRepository $report) {
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
		$member = $this->getMember($memberId);
		$report = $this->report;

		if ($member != false) {
			$report = view('reports.contracts_saving', compact('member'))->render();
		}

		return view('layouts.printing', compact('report'));
	}
	/**
	 * Get loan contract number
	 * @param  $memberId
	 * @return mixed
	 */
	public function contractLoan($loanId,Loan $loan) {
		 
		 $report = $loan->findOrFail($loanId)->contract;
		return view('layouts.printing', compact('report'));
	}

	/**
	 * Get member by his ID
	 * @param  INTEGER $memberId [description]
	 * @return Model
	 */
	private function getMember($memberId) {
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
	public function accountingPiece(Posting $posting, $startDate=null,$endDate=null,$excel)
	{
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
    public function loanRecords(Loan $loan, $startDate=null,$endDate=null,$excel=0,$adhersionId,$excel=1)
    {
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
    	$contributions = $contribution->with('member')->betweenDates($startDate,$endDate)->where('adhersion_id',$adhersionId)->get();
    	$report = view('reports.member.contributions',compact('contributions'))->render();
    	if ($excel==1) {
			 toExcel($report,'contributions-report');
		}
    	return view('layouts.printing', compact('report'));
    }
}
