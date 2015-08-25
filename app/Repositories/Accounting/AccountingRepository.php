<?php
namespace Ceb\Repositories\Accounting;

use Ceb\Models\Account;
use Ceb\Models\Journal;
use Ceb\Models\Posting;
use Ceb\Traits\TransactionTrait;
use DB;
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
		// Start saving if something fails cancel everything
		DB::beginTransaction();

		// Since we are done let's make sure everything is cleaned fo
		// the next transaction
		$transactionid = $this->getTransactionId();
		$debits = $this->joinAccountWithAmount($accoutingData['debit_accounts'], $accoutingData['debit_amounts']);
		$credits = $this->joinAccountWithAmount($accoutingData['credit_accounts'], $accoutingData['credit_amounts']);

		// now we have reached so we can continue with saving posting
		$savePostings = $this->savePostings($transactionid, $accoutingData['journal'], $debits, $credits);

		// Rollback the transaction via if one of the insert fails
		if (!$savePostings) {
			DB::rollBack();
			return false;
		}
		// Lastly, Let's commit a transaction since we reached here
		DB::commit();
		flash()->success(trans('accounting.transaction_is_recorded_successfully_transaction_id_is').$transactionid);
		return true;
	}

	/**
	 * Validate input information
	 * @param  array  $accoutingData
	 * @return bool true / false
	 */
	private function isValidInput(array $accoutingData) {
		// Check if all input has information
		$debits = $this->joinAccountWithAmount($accoutingData['debit_accounts'], $accoutingData['debit_amounts']);

		$credits = $this->joinAccountWithAmount($accoutingData['credit_accounts'], $accoutingData['credit_amounts']);

		return $this->isValidPosting($debits, $credits);
	}

}
?>