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
			'accounting.credit_form',
			'contributionsandsavings.form',
		];

		view()->composer($views, 'Ceb\ViewComposers\AccountViewComposer');
	}
	/**
	 * Institution view Composers
	 * @return mixed
	 */
	private function composerInstitutions() {
		$views = [
			'members.form',
		];
		view()->composer($views, 'Ceb\ViewComposers\InstitutionsViewComposer');
	}

	private function composerMembers() {
		$views = [
			'partials.nav_left',
		];

		view()->composer($views, 'Ceb\ViewComposers\MembersViewComposer');
	}
}
