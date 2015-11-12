<?php
namespace Ceb\ViewComposers;

use Illuminate\Contracts\View\View;

/**
 * AccountViewComposer
 */
class LoanStatusViewComposer {
	public function compose(View $view) {
		$loanStatuses = 
					[
					'all'       => trans('general.all'),
					'approved'	=>	trans('loan.approved'),
					'pending' 	=> 	trans('loan.pending'),
					'rejected' 	=>	trans('loan.rejected'),
					];

		$view->with('loanStatuses',$loanStatuses);
	}
}