<?php
namespace Ceb\ViewComposers;

use Ceb\Repositories\Loan\LoanRepository;
use Illuminate\Contracts\View\View;

/**
 * AccountViewComposer
 */
class DashboardViewComposer {
	
	public $loans;

	function __construct(LoanRepository $loanRepository) {

		$this->loans['ordinary_loan'] 			= $loanRepository->getOrdinaryLoanSum();
		$this->loans['social_loan']				= $loanRepository->getSocialLoanSum();
		$this->loans['special_loan'] 			= $loanRepository->getSpecialLoanSum();
		$this->loans['urgent_ordinary_loan'] 	= $loanRepository->getUrgentOrdinaryLoanSum();
		$this->loans['outstanding_loan']		= $loanRepository->getOutStandingAmount();
		$this->loans['fullpaid']				= $loanRepository->FullPaid();
	}

	public function compose(View $view) {
		$view->with('dashboarddata',$this->loans);
	}
}