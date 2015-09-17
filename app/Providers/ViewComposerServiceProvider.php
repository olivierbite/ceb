<?php

namespace Ceb\Providers;

use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot() {
		$this->composerAccounting();
		$this->composerInstitutions();
		$this->composerMembers();
		$this->composerMonthYear();
		$this->composerJournals();
		$this->composerLoanTypes();
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register() {
		//
	}

	/**
	 * Accounts view composers
	 * @return mixed
	 */
	private function composerAccounting() {
		$views = [
			'accounting.debit_form',
			'accounting.debit',
			'accounting.credit',
			'accounting.credit_form',
			'contributionsandsavings.form',
			'refunds.form',
		];

		view()->composer($views, 'Ceb\ViewComposers\AccountViewComposer');
	}
	/**
	 * Institution view Composers
	 * @return void
	 */
	private function composerInstitutions() {
		$views = [
			'members.form',
			'refunds.form',
		];
		view()->composer($views, 'Ceb\ViewComposers\InstitutionsViewComposer');
	}
	/**
	 * Member View Composer
	 *
	 * @return void
	 */
	private function composerMembers() {
		$views = [
			'partials.nav_left',
			'partials.dashboard',
		];

		view()->composer($views, 'Ceb\ViewComposers\MembersViewComposer');
	}

	/**
	 * Month Year view composer
	 * @return void
	 */
	private function composerMonthYear() {
		$views = [
			'refunds.form',
		];

		view()->composer($views, 'Ceb\ViewComposers\MonthYearViewComposer');

	}
	/**
	 * Journals view composer
	 * @return void
	 */
	private function composerJournals() {

		$views = [
			'accounting.journal',
		];

		view()->composer($views, '\Ceb\ViewComposers\JournalViewComposer');
	}

	/**
	 * LoanTypes view composer
	 * @return void 
	 */
	private function composerLoanTypes()
	{
		$views = [
			'loansandrepayments.ordinary_loan_form',
			'loansandrepayments.special_loan_form'

		
		];
		view()->composer($views, '\Ceb\ViewComposers\LoanTypeViewComposer');
	}
}
