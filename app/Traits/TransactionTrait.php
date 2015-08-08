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
		return 'CONTRACT' . date('YmdHiS') . (string) Sentry::getUser()->id;
	}

	/**
	 * Check if two array don't have one or more
	 * key that are similar to compaire them
	 * @param  array   $array1 First array to compaire
	 * @param  arry    $array2 Second array to compaire same as the first
	 * @return boolean true or False
	 */
	private function hasNoIdenticalKey(array $array1, array $array2) {

		// Search all the array keys
		foreach ($array1 as $key => $value) {
			if (array_key_exists($key, $array2)) {
				// We just found one key that is in another array
				// We don't have anything to do here, just exit
				// with bad news....
				return false;
			}
		}

		// Ahwiiii ! now we are good to go cause we have
		// good news
		return true;
	}
}
