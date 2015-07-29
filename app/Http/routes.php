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

/** Members routes */
Route::get('members/search', 'MemberController@search');
Route::resource('members', 'MemberController');

/** Contribution routes */
Route::get('contributions/complete', [
	'as' => 'contributions.complete', 'uses' => 'ContributionAndSavingsController@complete',
]);
Route::get('contributions/cancel', [
	'as' => 'contributions.cancel', 'uses' => 'ContributionAndSavingsController@cancel',
]);
Route::resource('contributions', 'ContributionAndSavingsController');

//Loan Routets
Route::get('/loans/{id}', 'LoanController@selectMember')->where('id', '[0-9]+');
Route::get('/loans/cancel', ['as' => 'loan.cancel', 'uses' => 'LoanController@cancel']);
Route::get('/loans/complete', ['as' => 'loan.complete', 'uses' => 'loanController@complete']);
Route::resource('loans', 'LoanController');

/** Ajax routes */
Route::group(['prefix' => 'ajax'], function () {
	Route::get('/loans', 'loanController@ajaxFieldUpdate');
});

/** Files routes */
Route::get('files', 'FileController@index');
Route::get('files/get/{filename}', [
	'as' => 'files.get', 'uses' => 'FileController@get']);
Route::post('files/add', [
	'as' => 'files.add', 'uses' => 'FileController@add']);

Route::get('/test', function () {
	$data = ['name' => 'kamaro'];

	dd(array_values($data)[0]);
});
