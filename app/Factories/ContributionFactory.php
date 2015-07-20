<?php
namespace Ceb\Factories;
use Ceb\Models\Institution;
use Illuminate\Support\Facades\Session;

/**
 * This factory helps Contribution
 */
class ContributionFactory {

	function __construct(Session $session, Institution $institution) {
		$this->session = $session;
		$this->institution = $institution;
	}

	public function setByInsitution($institutionId = 1) {

		// Do we have some savings ongoing ?
		if (Session::has('contributions') && count($this->getConstributions()) > 0) {
			// We have things in the session continue with them first
			return true;
		}
		// Get the institution by its id
		$members = $this->institution->find($institutionId)->members;

		$this->setContributions($members->toArray());
	}

	/**
	 * setContributions description
	 * @param array $data
	 */
	public function setContributions(array $data) {
		$finalData = [];
		foreach ($data as $item) {
			$item['institution'] = $this->institution->find($item['institution_id'])->name;

			$finalData[] = $item;
		}
		return Session::put('contributions', $finalData);
	}

	/**
	 * Get all contributions as per the current session
	 * @return array
	 */
	public function getConstributions() {
		return Session::get('contributions');
	}

	/**
	 * Update a single monthly contribution for a given uses
	 * @param  [type] $adhersion_number [description]
	 * @param  [type] $newValue         [description]
	 * @return [type]                   [description]
	 */
	public function updateMonthlyFee($adhersion_number, $newMontlyFee) {
		// First get what is in the session now
		$data = $this->getConstributions();
		// in (PHP 5 >= 5.5.0) you don't have to write your own function to search through a multi dimensional array
		$key = $this->searchAdhersionKey($adhersion_number, $data);

		// An array can have index 0 that's why we check if it's not strictly false
		if ($key !== false) {
			$data[$key]['monthly_fee'] = $newMontlyFee;
		}
		// Now we are ready to go
		return $this->setContributions($data);
	}

	/**
	 * Get total Montly fees
	 * @return number
	 */
	public function total() {
		$content = $this->getConstributions();
		$sum = 0;
		if (count($content) < 1) {
			return $sum;
		}
		// now calculate all amount we have
		foreach ($content as $item) {
			$sum += $item['monthly_fee'];
		}
		return $sum;
	}

	protected function searchAdhersionKey($keyword, $data) {
		foreach ($data as $key => $value) {
			$current_key = $key;

			if ($value['adhersion_id'] == $keyword) {
				return $current_key;
			}
		}
		return false;
	}
}