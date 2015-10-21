<?php
namespace Ceb\Factories;
use Ceb\Models\Institution;
use Ceb\Traits\TransactionTrait;
use Ceb\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Collection;

/**
 * This factory helps Contribution
 */
class ContributionFactory {
	use TransactionTrait;
	function __construct(Session $session, Institution $institution,User $member) {
		$this->session = $session;
		$this->member = $member;
		$this->institution = $institution;
	}

	/**
	 * Set members by institutions
	 * @param integer $institutionId
	 */
	public function setByInsitution($institutionId = 1) {

		// Do we have some savings ongoing ?
		if (Session::has('contributions') && count($this->getConstributions()) > 0) {
			// We have things in the session
			// Clear the session befor continuing
			$this->clearAll();
		}
		// Get the institution by its id
		$members = $this->institution->find($institutionId)->members;
		$this->setContributions($members->toArray());
	}

    /**
	 * Set members
	 * @param integer $memberId
	 *
	 * @return bool
	 */
	public function setMember($memberToSet= array())
	{	
		$members = array();

		// Check if the provided parameter is an id for one member or not
		if (!is_array($memberToSet) && is_numeric($memberToSet)) {
			$member = $this->member->findOrFail($memberId);
		    $members[] = $member->toArray();
		    $this->setContributions($members);
			return true;
		}

		// We have many members to upload
		if (is_array($memberToSet)) {

			$rowsWithErrors  		 = [];
			$rowsWithSuccess 		 = [];
			$rowsWithDifferentAmount = [];

			foreach ($memberToSet as $member) {

				    if (!isset($member[0]) || !isset($member[1])) {
				    	$rowsWithErrors[] = $member;
				    	continue;
				    }
               
				    $memberFromDb = $this->member->findByAdhersion($member[0]);
				    // Does contribution look same as the one registered
				    if ($memberFromDb->monthly_fee != $member[1]) {
				    	$memberFromDb->monthly_fee = $member[1];
				    	$memberFromDb->institution = $memberFromDb->institution->name;
				    	$rowsWithDifferentAmount[] = $memberFromDb;
				    }

				    $rowsWithSuccess[] = $memberFromDb;
				}	
		}

		$rowsWithErrors  		  = new Collection($rowsWithErrors);
		$rowsWithDifferentAmount  = new Collection($rowsWithDifferentAmount);
		$rowsWithSuccess  		  = new Collection($rowsWithSuccess);
		
		if (!$rowsWithErrors->isEmpty()) {
		   $message = 'We have identified '.$rowsWithErrors->count().' member(s) with wrong format, therefore we did not consider them.';	
		}

		if (!$rowsWithDifferentAmount->isEmpty()) {
		   $message = 'We have identified '.$rowsWithErrors->count().' member(s) with  diffent contributions amount.';	
		}

		flash()->error($message);
		Session::put('contributionsWithDifference',$rowsWithDifferentAmount);
		Session::put('uploadsWithErrors', $rowsWithErrors);

		$this->setContributions($rowsWithSuccess->toArray());
		return true;
	}
    /**
	 * Set members who are about to contribute
	 * @param array $members
	 */
	public function setContributionMembers(array $members) {
		Session::put('contributionMembers', $members);
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
		return new Collection(Session::get('contributions'));
	}

	/**
	 * Get contributions with differences
	 * 
	 * @return [type] [description]
	 */
	public function getConstributionsWithDifference()
	{
		return new Collection(Session::get('contributionsWithDifference'));
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

	/**
	 * Set debit account
	 * @param mixed $accountId
	 */
	public function setDebitAccount($accountId) {
		return Session::put('debit_account', $accountId);
	}

	/**
	 * GetDebit account id
	 * @return Integer
	 */
	public function getDebitAccount() {
		return Session::get('debit_account', 13);
	}
	/**
	 * Set credit account in the session
	 * @param integer $accountId Account ID to be credited
	 */
	public function setCreditAccount($accountId) {
		return Session::put('credit_account', $accountId);
	}
	/**
	 * get current set credited account
	 * @return [type] [description]
	 */
	public function getCreditAccount() {
		return Session::get('credit_account', 26); // Here we assume the account with id 26 is default
	}

	/**
	 * Set the month we are paying for
	 * @param mixed $month
	 */
	public function setMonth($month) {
		return Session::put('month', $month);
	}

	/**
	 * Get the contribution month
	 * @return integer
	 */
	public function getMonth() {
		return Session::get('month', date('m'));
	}

	/**
	 * Set the institution
	 * @param mixed $institutionId
	 */
	public function setInstitution($institutionId) {
		return Session::put('institution', $institutionId);
	}
	/**
	 * get the current contribution institutions
	 * @return ID
	 */
	public function getInstitution() {
		return Session::get('institution', 1); // We assume institution 1 is dhe default one
	}

	/**
	 * Clear all present SessionIds
	 * @return void
	 */
	public function clearAll() {
		Session::forget('contributions');
		Session::forget('debit_account');
		Session::forget('credit_account');
		Session::forget('month');
		Session::forget('institution');
		Session::forget('uploadsWithErrors');
		Session::forget('contributionsWithDifference');
	}
}