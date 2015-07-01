<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

Route::get('/', ['as' => 'home', 'middleware' => 'sentry.auth', function () {
	return view('layouts.default');
}]);

Route::resource('members', 'MemberController');

Route::get('/test', function () {
	dd(new Ceb\Repositories\Member\MemberRepository);
});