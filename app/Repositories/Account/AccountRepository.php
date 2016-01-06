<?php
namespace Ceb\Repositories\Account;
use Ceb\Models\Account;

/**
 * Account repositotyr
 */
class AccountRepository implements AccountRepositoryInterface {

	function __construct(Account $account) {
		$this->account = $account;
	}

	public function getAll() {
		return $this->account->all();
	}

	public function lists() {
		return $this->account->lists('entitled', 'id');
	}

	public function dropDownList()
	{
		$accounts = $this->account->orderBy('account_number')->get();
		$accountsList = [];
		foreach ($accounts as $account) {
			$accountsList[$account->id] = $account->account_number.' - '.$account->entitled;
		}

		return $accountsList;
	}
}