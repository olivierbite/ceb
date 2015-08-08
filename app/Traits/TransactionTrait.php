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
	 * Get unique contribution
	 * contract Number for the
	 * Transaction
	 */
	private function getContributionContractNumber() {
		return 'CONTRACT' . date('Ymd') . (string) ($this->contribution->count() + 1);
	}

}
