<?php
namespace Ceb\Factories;
use Ceb\Models\DefaultAccount;
use Ceb\Models\Institution;
use Ceb\Models\User;
use Ceb\Traits\TransactionTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Session;

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
		$toSetMembers =[];
		foreach ($members as $member) {
			$member->monthly_fee = (int) $member->monthly_fee;
			$toSetMembers[] = $member;
		}
		$this->setContributions($toSetMembers);
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
			$member->monthly_fee = (int) $member->monthly_fee;
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
					$memberFromDb->monthly_fee = (int) $memberFromDb->monthly_fee;
					$member[1] = (int) $member[1];
				    // Does contribution look same as the one registered
				    if ($memberFromDb->monthly_fee !== $member[1]) {
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
		   $message = 'We have identified '.$rowsWithDifferentAmount->count().' member(s) with  diffent contributions amount.';	
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
	 * Set wording for the current contribution
	 * 
	 * @param void
	 */
	public function setWording($wording)
	{
		Session::put('contribution_wording', $wording);
	}

	/**
	 * Get wording for current contributionsession
	 * 
	 * @return string
	 */
	public function getWording()
	{
		return Session::get('contribution_wording', null);
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
		$data = $this->getConstributions()->toArray();
		// in (PHP 5 >= 5.5.0) you don't have to write your own function to search through a multi dimensional array
		$key = $this->searchAdhersionKey($adhersion_number, $data);

		// An array can have index 0 that's why we check if it's not strictly false		
		if ($key !== false) {
			$data[$key]['monthly_fee'] = (int) $newMontlyFee;
		}

		// Now we are ready to go
		return $this->setContributions($data);
	}

	/**
	 * Remove one member from current contribution session
	 * 
	 * @param  numeric $memberId
	 * @return void
	 */
	public function removeMember($adhersion_number)
	{
      $adhersion_number = (int) $adhersion_number;

	  $filtered = $this->getConstributions()->filter(function($member)  use ($adhersion_number){
	  	  if ($member['adhersion_id'] == $adhersion_number) {
	  	  	flash()->warning($member['first_name'].' '.$member['last_name'].'('.$adhersion_number.')'.trans('contribution.has_been_removed_from_current_contribution_session'));
	  	  	return false;
	  	  }

	  	  return true;
	  });

	  $this->setContributions($filtered->toArray());	
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

		$defaultDebitAccount	=  DefaultAccount::with('accounts')->debit()->batchContribution()->first()->accounts->first();
		return Session::get('debit_account', $defaultDebitAccount->id);
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
		
		$defaultCreditAccount	=  DefaultAccount::with('accounts')->credit()->batchContribution()->first()->accounts->first();
		return Session::get('credit_account', 0); // Here we assume the account with id 26 is default
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
		return Session::get('month', 0);
	}

	/**
	 * Set the institution
	 * @param mixed $institutionId
	 */
	public function setInstitution($institutionId) {
		return Session::put('contribution_institution', $institutionId);
	}

	/**
	 * get the current contribution institutions
	 * @return ID
	 */
	public function getInstitution() {
		return Session::get('contribution_institution', 0); // We assume institution 1 is dhe default one
	}

	/**
	 * Forget contribution with differences
	 * 		
	 * @return void
	 */
	public function forgetWithDifferences()
	{
		$withDifference = $this->getConstributionsWithDifference();
		$members        = $this->getConstributions();

		$members = $members->filter(function($member) use($withDifference){
		    return $withDifference->where('adhersion_id',$member['adhersion_id'])->isEmpty();
		});

		flash()->success($this->getConstributions()->count() - $members->count() . trans('contribution.members_are_removed_from_this_contribution_session'));

		$this->setContributions($members->toArray());
		$this->forgetContributionWithDifferences();
	}

	/**
	 * Remove contribution with differencdes
	 * 
	 * @return void
	 */
	public function forgetContributionWithDifferences()
	{
		Session::forget('contributionsWithDifference');
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
		Session::forget('contribution_institution');
		Session::forget('uploadsWithErrors');
		Session::forget('contributionsWithDifference');
		Session::forget('contribution_wording');
	}
}