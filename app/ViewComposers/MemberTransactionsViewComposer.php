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
											'individual_monthly_contribution'			=>'individual_monthly_contribution',
											'annual_interest'							=>'annual_interest',
											'returned_interest'							=>'returned_interest',
											'remainers'									=>'remainers',
											'repayments_of_third_party_debt_payment'	=>'repayments_of_third_party_debt_payment',
											'regularization'							=>'regularization',
											'other_savings'								=>'other_savings',
							 			],

							 'withdrawal'=>[
											'withdrawal_a_third'			=>'withdrawal_a_third',
											'full_withdrawal_savings'		=>'full_withdrawal_savings',
											'withdrawal_social_portion'		=>'withdrawal_social_portion',
											'release_social_portion'		=>'release_social_portion',
											'annual_interest_withdrawal'	=>'annual_interest_withdrawal',
											'withdrawal_returned_interests'	=>'withdrawal_returned_interests',
											'withdrawal_remaining_balances'	=>'withdrawal_remaining_balances',
											'regularization'				=>'regularization',
											'other_withdrawals'				=>'other_withdrawals',
							 			],
							];


	public function compose(View $view) {

		$transactionTypes = [];
		foreach ($this->transactions as $key => $value) {
			$transactionTypes[$key] = trans('member.'.$key);
		}
		
		$view->with(['memberTransactions'=> $this->transactions,'transactionTypes'=>$transactionTypes]);
	}
}