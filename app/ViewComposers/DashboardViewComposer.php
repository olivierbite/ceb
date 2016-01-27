<?php
namespace Ceb\ViewComposers;

use Ceb\Models\Institution;
use Ceb\Models\Loan;
use Ceb\Models\Refund;
use Ceb\Models\User;
use Illuminate\Contracts\View\View;

/**
 * AccountViewComposer
 */
class DashboardViewComposer {
	
	public $dashboard  = [];

	function __construct(Institution $institution,Loan $loan,User $member,Refund $refund) {

		$this->dashboard['ordinary_loan']			= $loan->ofStatus('approved')->ofType('ordinary_loan')->sum('loan_to_repay');
		$this->dashboard['social_loan']				= $loan->ofStatus('approved')->ofType('social_loan')->sum('loan_to_repay');
		$this->dashboard['special_loan']			= $loan->ofStatus('approved')->ofType('special_loan')->sum('loan_to_repay');
		$this->dashboard['urgent_ordinary_loan']	= $loan->ofStatus('approved')->ofType('urgent_ordinary_loan')->count();
		$this->dashboard['refunded_amount']			= $refund->sumRefunds();
		$this->dashboard['outstanding_loan']		= $loan->sumOutStanding();
		$this->dashboard['left_members_count']		= $member->hasLeft()->count();
		$this->dashboard['active_members_count']	= $member->isActive()->count();
		$this->dashboard['institutions']			= $institution->count();
		$this->dashboard['outstandingLoans']		= $loan->countOutStanding();
		$this->dashboard['paidLoans']				= $loan->countPaid();				
	}

	public function compose(View $view) {
		$view->with('dashboarddata',$this->dashboard);
	}
}