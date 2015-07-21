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

		$institutionId = $this->contributionFactory->getInstitution();
		if (Input::has('institution')) {
			$institution = Input::get('institution');
			$this->contributionFactory->setInstitution($institutionId);
		}

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

		// If we have Debit account in the url , then set it
		if (Input::has('debit_account')) {
			$this->contributionFactory->setDebitAccount(Input::get('debit_account'));
		}

		// If we have Credit account in the url then set credit account
		if (Input::has('credit_account')) {
			$this->contributionFactory->setCreditAccount(Input::get('credit_account'));
		}

		// If we have month in the parameters set it
		if (Input::has('month')) {
			$this->contributionFactory->setMonth(Input::get('month'));
		}

		$month = $this->contributionFactory->getMonth();
		$debitAccount = $this->contributionFactory->getDebitAccount();
		$creditAccount = $this->contributionFactory->getCreditAccount();
		$members = $this->contributionFactory->getConstributions();
		$total = $this->contributionFactory->total();
		$institutions = $this->institution->lists('name', 'id');
		$accounts = $this->account->lists('entitled', 'id');

		return view('contributionsandsavings.list', compact('members', 'institutions', 'institutionId', 'accounts', 'total', 'debitAccount', 'creditAccount', 'month'));

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
