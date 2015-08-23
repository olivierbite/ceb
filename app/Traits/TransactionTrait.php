<?php namespace Ceb\Traits;
use Ceb\Models\Contribution;
use DateTime;
use Sentry;
trait TransactionTrait {
	/**
	 * Get unique transaction ID
	 * @return string
	 */
	private function getTransactionId() {
		return (new DateTime)->format('YmdHi') . Sentry::getUser()->id;
	}
	/**
	 * Search  adhresion key
	 * @param   $keyword
	 * @param   $data
	 * @return
	 */
	protected function searchAdhersionKey($keyword, $data) {
		foreach ($data as $key => $value) {
			$current_key = $key;

			if ($value['adhersion_id'] == $keyword) {
				return $current_key;
			}
		}
		return false;
	}

	/**
	 * Get unique contribution
	 * contract Number for the
	 * Transaction
	 */
	private function getContributionContractNumber() {
		return 'CONTRACT' . date('YmdHis') . (string) Sentry::getUser()->id;
	}

	/**
	 * Mapping the accounts with their amount
	 * @param array $accounts accounts IDs
	 * @param array $amounts  accounts Amount
	 */
	public function accountAmount(array $accounts, array $amounts) {

		dd($amounts);
		$newData = [];
		foreach ($accounts as $key => $value) {
			if ((empty($amounts[$key]['value']) || trim($amounts[$key]['value']) == '')) {
				// This account doesn't have amount therefore
				// Let's go to the next one
				continue;
			}
			$newData[$value['value']] = $amounts[$key]['value'];

		}
		// Make sure we remove anything with zero
		// or Empty value before we close
		return array_filter($newData);
	}

	/**
	 * Validate if the accounts and amount per accounts
	 * are valid before saving them in the database
	 * @return boolean
	 */
	public function isValidPosting($debits = [], $credits = []) {

		// First check if the sum of both credits
		// and Debits has same sum of amount so that
		// we can make sure that this double entry is balanced
		if (array_sum($credits) != array_sum($debits)) {
			// just exit because we have nothing to do here...
			flash()->error(trans('loan.debits_and_credits_amount_must_be_equal'));
			return false;
		}

		// Let's check if the user is trying to debit and credit
		// Same account, which is not allowed as per account laws

		if (empty(count(array_diff_key($debits, $credits)))) {
			flash()->error(trans('loan.it_is_not_allowed_to_credit_and_debit_same_account_please_correct_and_try_again'));
			return false;
		}
		// Ahwii ! time to read the bible, let's exit here wi
		// Good news
		return true;
	}

	/**
	 * Save postings in the database
	 * @param  numeric  $accountId
	 * @param  numeric  $amount
	 * @param  numeric  $transactionId
	 * @param  numeric  $transactionumeric
	 * @param  integer  $journalId
	 * @return     bool
	 */
	public function savePosting($accountId, $amount, $transactionId, $transactionType, $journalId = 1) {
		// First prepare data to use for the debit account
		// Once are have debited(deducted data) then we can
		// Credit the account to be credited
		$posting['transactionid'] = $transactionId;
		$posting['account_id'] = $accountId;
		$posting['journal_id'] = $journalId; // We assume per default we are using journal 1
		$posting['asset_type'] = null;
		$posting['amount'] = $amount;
		$posting['user_id'] = Sentry::getUser()->id;
		$posting['account_period'] = date('Y');
		$posting['transaction_type'] = $transactionType;

		// Try to post the debit before crediting another account
		return $this->posting->create($posting);

	}

	/**
	 * Save posting to the database
	 * @param  STRING $transactionId UNIQUE TRANSACTIONID
	 * @return bool
	 */
	private function savePostings($transactionId, $journalId = 1, $debits = [], $credits = []) {

		// Start by validating the information we
		// are about to svae in our database
		if (!$this->isValidPosting()) {
			return false;
		}

		//Debiting....
		$debits = (!empty($debits)) ? $debits : $this->getDebitAccounts();

		foreach ($debits as $accountId => $amount) {
			$results = $this->savePosting($accountId, $amount, $transactionId, 'Debit', $journalId);
			if (!$results) {
				return false;
			}
		}

		//Crediting
		$credits = (!empty($credits)) ? $credits : $this->getCreditAccounts();
		foreach ($credits as $accountId => $amount) {
			$results = $this->savePosting($accountId, $amount, $transactionId, 'Credit', $journalId);
			if (!$results) {
				return false;
			}
		}
		// We are safe here
		return true;
	}

}
