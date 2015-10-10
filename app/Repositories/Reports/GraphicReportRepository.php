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
    	return $this->institution->with('members')->get(['name',DB::raw('count(members)')]);
    }

    /**
	 * Get count of member per institution
	 * @return array
	 */
    public function getMonthlyContribution()
    {
    	return $this->contribution->groupBy(DB::raw('month'))
    					  ->get(
    					  		[DB::raw('CONCAT(year,month) as month'),
    					  		DB::raw('round(sum(amount)) as amount')
    					  	]);
    }



}
