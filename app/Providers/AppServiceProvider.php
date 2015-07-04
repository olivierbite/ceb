<?php

namespace Ceb\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {
		$this->app->bind('\Ceb\Repositories\Member\MemberRepositoryInterface',
			'\Ceb\Repositories\Member\MemberRepository');
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register() {
		//
	}
}
