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
		$newData = [];
		foreach ($accounts as $key => $value) {
			if (empty($amounts[$key]['value']) || trim($amounts[$key]['value']) == '') {
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

}
