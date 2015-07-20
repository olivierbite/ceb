<?php

namespace Ceb\Http\Controllers;

use Ceb\Factories\ContributionFactory;
use Ceb\Http\Controllers\Controller;
use Ceb\Models\Account;
use Ceb\Models\Institution;
use Ceb\Repositories\Contribution\ContributionRepository as Contribution;
use Input;

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

		$institutionId = Input::get('institution');
		$institutionId = $institutionId ?: 1;

		$this->contributionFactory->setByInsitution($institutionId);

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

	private function reload() {

		$members = $this->contributionFactory->getConstributions();
		$total = $this->contributionFactory->total();
		$institutions = $this->institution->lists('name', 'id');
		$accounts = $this->account->lists('entitled', 'id');

		return view('contributionsandsavings.list', compact('members', 'institutions', 'institutionId', 'accounts', 'total'));

	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {

	}
}
