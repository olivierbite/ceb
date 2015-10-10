<?php namespace Ceb\Repositories\Reports;

use Ceb\Models\Account;
use Ceb\Models\Attorney;
use Ceb\Models\Contribution;
use Ceb\Models\Institution;
use Ceb\Models\Journal;
use Ceb\Models\Loan;
use Ceb\Models\User;
use Ceb\Traits\FileTrait;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Support\Facades\DB;
use Str;

class GraphicReportRepository {

	public $member;
	public $account;
	public $contribution;
	public $institution;
	public $loan;			


	/**
	 * Class GraphicReportRepository
	 * @param    $member   
	 * @param    $account   
	 * @param    $contribution   
	 * @param    $loan   
	 */
	public function __construct(User $member,Account $account,Contribution $contribution,Loan $loan,Institution $institution)
	{
		$this->member = $member;
		$this->account = $account;
		$this->institution = $institution;
		$this->contribution = $contribution;
		$this->loan = $loan;
	}

	/**
	 * Get count of member per institution
	 * @return array
	 */
    public function getCountMemberPerInstitution()
    {
    	return $this->institution->with('members')->get();
    }

    /**
     * Get Institutions with loans
     * @return object 
     */
    public function getLoanByInstitution()
    {
    	return $this->institution->with('loans')->get();
    }

    /**
	 * Get count of member per institution
	 * @return array
	 */
    public function getMonthlyContribution()
    {
    	return $this->contribution->groupBy(DB::raw('month'))
    	                  ->where('year','>=' ,DB::raw('YEAR(CURRENT_DATE - INTERVAL 12 MONTH)'))
    	                  ->where('month','>=',DB::raw('MONTH(CURRENT_DATE - INTERVAL 12 MONTH)'))
    					  ->get([
    					  	 	DB::raw('CONCAT(year,month) as month'),
    					  		DB::raw('round(sum(amount)) as amount')
    					  	]);
    }

    public function getMontlyLoan()
    {
    	return $this->loan->groupBy(DB::raw('month'))	
    	                  ->where(DB::raw('YEAR(letter_date)'),'>=' ,DB::raw('YEAR(CURRENT_DATE - INTERVAL 12 MONTH)'))
    	                  ->where(DB::raw('MONTH(letter_date)'),'>=',DB::raw('MONTH(CURRENT_DATE - INTERVAL 12 MONTH)'))
    					  ->get([
    					  	 	DB::raw('CONCAT(YEAR(letter_date),MONTH(letter_date)) as month'),
    					  		DB::raw('round(sum(loan_to_repay)) as amount')
    					  	]);
    }



}
