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
}