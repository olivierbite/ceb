<?php
namespace Ceb\ViewComposers;

use Illuminate\Contracts\View\View;

/**
 * AccountViewComposer
 */
class LoanTypeViewComposer {
	public function compose(View $view) {
	    $loanType = [
					'ordinary_loan'=>trans('loans.ordinary_loan'),
		            'urgent_ordinary_loan'=>trans('loans.urgent_ordinary_loan'),
		            'special_loan'=>trans('loans.special_loan'),
	             	'social_loan'=>trans('loans.social_loan'),             	
	             	'emergency_loan'=>trans('loans.emergency_loan'),
		            ];
		$view->with('loanTypes', $loanType);
	}
}