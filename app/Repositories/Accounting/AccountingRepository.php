<?php
namespace Ceb\Repositories\Accounting;

use Ceb\Models\Account;
use Ceb\Models\Journal;
use Ceb\Models\Posting;
use Ceb\Traits\TransactionTrait;

/**
 * Accounting repository class
 */
class AccountingRepository {

	use TransactionTrait;
	function __construct(Journal $journal, Account $account, Posting $posting) {
		$this->Journal = $journal;
		$this->account = $account;
		$this->posting = $posting;
	}

	/**
	 * Create new account transactions
	 * @param array $accouting contrains the data to use during accounting
	 */
	public function complete(array $accoutingData) {
		// Start by validating provided information
		if (!$this->isValidInput($accoutingData)) {
			return false;
		}

		$transactionid = $this->getTransactionId();
		$debits = $this->accountAmount($accoutingData['debit_accounts'], $accoutingData['debit_amounts']);
		$credits = $this->accountAmount($accoutingData['credit_accounts'], $accoutingData['credit_amounts']);

		// now we have reached so we can continue with saving posting
		if (!$this->savePostings($transactionid, $accoutingData['journal'], $debits, $credits)) {
			return false;
		}
		return true;
	}

	/**
	 * Validate input information
	 * @param  array  $accoutingData
	 * @return bool true / false
	 */
	private function isValidInput(array $accoutingData) {
		// Check if all input has information
		$debits = $this->accountAmount($accoutingData['debit_accounts'], $accoutingData['debit_amounts']);

		$credits = $this->accountAmount($accoutingData['credit_accounts'], $accoutingData['credit_amounts']);

		return $this->isValidPosting($debits, $credits);
	}

}
?>