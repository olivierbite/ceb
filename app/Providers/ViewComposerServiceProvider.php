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
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register() {
		//
	}

	private function composerAccounting() {
		$views = [
			'accounting.debit_form',
			'accounting.credit_form',
			'contributionsandsavings.form',
		];

		view()->composer($views, 'Ceb\ViewComposers\AccountViewComposer');
	}
}
