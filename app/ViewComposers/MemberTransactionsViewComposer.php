<?php
namespace Ceb\ViewComposers;

use Ceb\Models\User;
use Illuminate\Contracts\View\View;

/**
 * member ViewComposer
 */
class MemberTransactionsViewComposer {

	/**
	 * Possible member transactions
	 * @var array
	 */
	private $transactions = [
							 'saving' =>[
							             'individual_monthly_contribution',
							             'annual_interest',
							             'returned_interest',
							             'remainders',
							             'repayments_of_third_party_debt_payment',
							             'regularization',
							             'other_savings',
							 			],

							 'withdrawal'=>[
							 			  'withdrawal_a_third',
							 			  'full_withdrawal_savings',
							 			  'withdrawal_social_portion',
							 			  'release_social_portion',
							 			  'annual_interest_withdrawal',
							 			  'withdrawal_returned_interests',
							 			  'withdrawal_remaining_balances',
							 			  'regularization',
							 			  'other_withdrawals',
							 			],
							];


	public function compose(View $view) {
		$this->transactions =  ['select_movement_type' => []] + $this->transactions;
		// dd(array_keys($this->transactions));
		$view->with('memberTransactions', $this->transactions);
	}
}