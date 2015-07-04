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

/** Files routes */
Route::get('files', 'FileController@index');

Route::get('files/get/{filename}', [
	'as' => 'files.get', 'uses' => 'FileController@get']);
Route::post('files/add', [
	'as' => 'files.add', 'uses' => 'FileController@add']);

Route::get('/api/users', function () {

	return Ceb\Models\User::where('first_name', 'LIKE', '%' . Input::get('query') . '%')
	->orWhere('last_name', 'LIKE', '%' . Input::get('query') . '%')
	->orWhere('member_nid', 'LIKE', '%' . Input::get('query') . '%')
	->orWhere('adhersion_id', 'LIKE', '%' . Input::get('query') . '%')->get();
});