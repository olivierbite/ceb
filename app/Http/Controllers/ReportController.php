<?php

namespace Ceb\Http\Controllers;

use Ceb\Http\Controllers\Controller;
use Ceb\Models\Account;
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
	public function accountingPiece(Posting $posting, $startDate=null,$endDate=null)
	{
		$postings = $posting->with('account')->betweenDates($startDate,$endDate)->get();
		return view('reports.accounting.piece',compact('postings'));
	}

	/**
	 * Show ledge  reports
	 * 
	 * @param  Ceb\Models\Posting $posting   
	 * @param  string  $startDate 
	 * @param  string  $endDate   
	 * @return view             
	 */
	public function ledger(Posting $posting, $startDate=null,$endDate=null)
	{
		$postings = $posting->with('account')->betweenDates($startDate,$endDate)->get();
		return view('reports.accounting.ledger',compact('postings'));
	}

	/**
	 * Show bilan report
	 * @param  Ceb\Models\Account $account   
	 * @param  string  $startDate 
	 * @param  string  $endDate   
	 * @return mixed             
	 */
	public function bilan(Account $account,$startDate=null,$endDate=null)
	{
		$accounts = $account->with('postings')->get();
		return view('reports.accounting.bilan',compact('accounts'));
	}

	/**
	 * Show ledge  reports
	 * 
	 * @param  Ceb\Models\Posting $posting   
	 * @param  string  $startDate 
	 * @param  string  $endDate   
	 * @return view             
	 */
	public function journal(Posting $posting, $startDate=null,$endDate=null)
	{
		$postings = $posting->with('account')->betweenDates($startDate,$endDate)->get();
		return view('reports.accounting.journal',compact('postings'));
	}

	/**
	 * Show accounts list report
	 * @param  Ceb\Models\Account $account   
	 * @param  string  $startDate 
	 * @param  string  $endDate   
	 * @return mixed             
	 */
	public function accountsList(Account $account)
	{
		$accounts = $account->all();
		return view('reports.accounting.accounts-list',compact('accounts'));
	}
}
