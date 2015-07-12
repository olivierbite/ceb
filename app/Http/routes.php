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
Route::resource('contributions', 'ContributionAndSavingsController');

/** Files routes */
Route::get('files', 'FileController@index');
Route::get('files/get/{filename}', [
	'as' => 'files.get', 'uses' => 'FileController@get']);
Route::post('files/add', [
	'as' => 'files.add', 'uses' => 'FileController@add']);
