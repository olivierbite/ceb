<?php namespace Ceb\Traits;
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
}
