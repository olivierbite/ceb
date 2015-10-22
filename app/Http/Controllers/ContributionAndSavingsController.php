<?php

namespace Ceb\Http\Controllers;

use Ceb\Factories\ContributionFactory;
use Ceb\Http\Controllers\Controller;
use Ceb\Models\Account;
use Ceb\Models\Institution;
use Ceb\Repositories\Contribution\ContributionRepository as Contribution;
use Input;
use League\Csv\Reader;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class ContributionAndSavingsController extends Controller {

	private $contribution;
	function __construct(Contribution $contribution, Institution $institution, Account $account, ContributionFactory $contributionFactory) {
		parent::__construct();
		$this->contribution = $contribution;
		$this->account = $account;
		$this->institution = $institution;
		$this->contributionFactory = $contributionFactory;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {

		return $this->reload();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return view('contributionsandsavings.create');
	}

	/**
	 * Show contributions
	 * @return function
	 */
	public function show() {
		return $this->reload();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		// Update
		$adhersion_number = Input::get('adhersion_number');
		$monthly_fee = Input::get('monthly_fee');

		$this->contributionFactory->updateMonthlyFee($adhersion_number, $monthly_fee);

		return $this->reload();
	}

	public function complete() {

		if ($this->contribution->complete() == true) {

			$this->contributionFactory->clearAll();
			$message = trans('contribution.contribution_well_saved');
			flash()->success($message);

			return redirect()->route('contributions.index');
		}
		$message = trans('contribution.something_went_wrong_while_saving_contribution');
		flash()->error($message);

		return redirect()->route('contributions.index');}
	/**
	 * Reload the current transactions pages
	 * @return mixed
	 */
	private function reload() {

		// Detect if there is something to set or be removed
		$this->setByInsitution();
		$this->setDebitAccount();
		$this->setCreditAccount();
		$this->setMonth();
		$this->removeContributionWithDifference();

		$month = $this->contributionFactory->getMonth();
		$debitAccount = $this->contributionFactory->getDebitAccount();
		$creditAccount = $this->contributionFactory->getCreditAccount();
        $contributionHasDifference = !$this->contributionFactory->getConstributionsWithDifference()->isEmpty();
		$members = $this->getMembers();
		$pageLinks = $this->getMembersPageLinks();

		$total = $this->contributionFactory->total();

		return view('contributionsandsavings.list', compact('members','pageLinks', 'institutionId', 'total', 'debitAccount', 'creditAccount', 'month','contributionHasDifference'));

	}

	/**
	 * Remove a member from the current contribution session
	 * 
	 * @param   $adhersion_id 
	 * @return  mixed
	 */
	public function removeMember($adhersion_id)
	{
		$this->contributionFactory->removeMember($adhersion_id);
		return $this->reload();
	}

	/**
	 * Cancel contribution
	 */
	public function cancel() {

		$this->contributionFactory->clearAll();
		$message = trans('contribution.contribution_cancelled');
		flash()->success($message);

		return redirect()->route('contributions.index');

	}

	/**
	 * Set multiple members by uploading a csv containing their adhersion id and amount
	 * 
	 * @return [type] [description]
	 */
	public function batch()
	{
		if (!Input::hasFile('file')) {
			flash()->error('Please select a file to upload');
			return $this->reload();
		}
		 if(Input::file('file')->getClientOriginalExtension() != 'csv') {
		    Flash::error('You must upload a csv file');
		    return $this->index();
		  }

	    // checking file is valid.
	    if (Input::file('file')->isValid()) {
	       
	       $csv = Reader::createFromPath(Input::file('file'));

	       $message = '';

		   $csv->setOffset(1); //because we don't want to insert the header
	       $members = $csv->fetchAll();
           $this->contributionFactory->setMember($members);
		}

		return $this->reload();
	}


	/**
	 * Get members who are set to contribute
	 * 
	 * @return Paginator
	 */
	private function getMembersPageLinks()
	{
		$currentPage = Input::get('page', 1);

		if (Input::has('show-member-with-difference') && Input::get('show-member-with-difference') == 'yes') {
			return new Paginator($this->contributionFactory->getConstributionsWithDifference(),20,$currentPage);
		}	
		return new Paginator($this->contributionFactory->getConstributions(),20,$currentPage);
	}

	/**
	 * Get members to be displayed
	 * @return collections
	 */
	private function getMembers()
	{
		$currentPage = Input::get('page', 1);
		if (Input::has('show-member-with-difference') && Input::get('show-member-with-difference') == 'yes') {
			return $this->contributionFactory->getConstributionsWithDifference()->forPage($currentPage,20);
		}	
		return $this->contributionFactory->getConstributions()->forPage($currentPage,20);
	}

	/**
	 * Set month for the contribution
	 * 
	 */
	private function setMonth()
	{
		if (Input::has('month')) {
			$this->contributionFactory->setMonth(Input::get('month'));
		}
	}

	/**
	 * Set credit account for this contribution
	 */
	private function setCreditAccount()
	{
		if (Input::has('credit_account')) {
			$this->contributionFactory->setCreditAccount(Input::get('credit_account'));
		}
	}

	/**
	 * Set debit account for this contribution
	 */
	private function setDebitAccount()
	{
		if (Input::has('debit_account')) {
			$this->contributionFactory->setDebitAccount(Input::get('debit_account'));
		}
	}

	/**
	 * Set members by institution
	 */
	private function setByInsitution()
	{
		if (Input::has('institution')) {
			$this->contributionFactory->setInstitution(Input::get('institution'));
			$this->contributionFactory->setByInsitution(Input::get('institution'));
		}
	}

	/**
	 * Remove contribution with differences
	 * 
	 * @return void
	 */
	public function removeContributionWithDifference()
	{
		if (Input::has('remove-member-with-differences') && Input::get('remove-member-with-differences') == 'yes') {
			$this->contributionFactory->forgetWithDifferences();
		}
	}
}
