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
	return view('partials.dashboard');
}]);

/** Members routes */
Route::get('members/search', 'MemberController@search');
Route::resource('members', 'MemberController');
Route::resource('attornies','AttorneyController');
Route::get('/members/{memberId}/refund',['as' => 'members.refund' , 'uses'=> 'MemberController@refund']);
Route::get('/members/{memberId}/contribute',['as' => 'members.contribute' , 'uses'=> 'MemberController@contribute']);
Route::get('/members/{memberId}/transacts',['as'=>'members.transacts','uses'=>'MemberController@transacts']);

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
Route::post('/loans/complete', ['as' => 'loan.complete', 'uses' => 'loanController@complete']);
Route::get('/loans/remove/cautionneur/{cautionneur}',
	['as' => 'loan.remove.cautionneur',
		'uses' => 'loanController@removeCautionneur']
)->where('cautionneur', '[A-Za-z0-9]+');
Route::get('/loans/setcautionneur', ['as' => 'loan.add.cautionneur', 'uses' => 'loanController@setCautionneur']);
Route::resource('loans', 'LoanController');

/** regularisation */
Route::resource('regularisation', 'RegularisationController');

/** Refunds routes */
// Route::get('/refunds/complete', ['as' => 'refunds.complete', 'uses' => 'RefundController@complete']);
Route::post('/refunds/complete', ['as' => 'refunds.complete', 'uses' => 'RefundController@complete']);
Route::get('/refunds/cancel', ['as' => 'refunds.cancel', 'uses' => 'RefundController@cancel']);
Route::resource('refunds', 'RefundController');

/** Accounting routes */
Route::resource('accounting', 'AccountingController');

/** Reporting routes */
Route::get('/reports', ['as' => 'reports.index', 'uses' => 'ReportController@index']);
Route::get('/reports/contracts/saving/{memberId}', ['as' => 'reports.contracts.saving', 'uses' => 'ReportController@contractSaving']);
Route::get('/reports/contracts/loan/{loanId}', ['as' => 'reports.contracts.loan', 'uses' => 'ReportController@contractLoan']);
Route::get('/reports/contracts/ordinaryloan', ['as' => 'reports.contracts.ordinaryloan', 'uses' => 'ReportController@ordinaryloan']);
Route::get('/reports/contracts/socialloan', ['as' => 'reports.contracts.socialloan', 'uses' => 'ReportController@socialloan']);

/** Ajax routes */
Route::group(['prefix' => 'ajax'], function () {
	Route::get('/loans', 'loanController@ajaxFieldUpdate');

	Route::post('/loans/accounting', ['as' => 'ajax.accounting', 'uses' => 'loanController@ajaxAccountingFeilds']);
});

/** Files routes */
Route::get('files', 'FileController@index');
Route::get('files/get/{filename}', [
	'as' => 'files.get', 'uses' => 'FileController@get']);
Route::post('files/add', [
	'as' => 'files.add', 'uses' => 'FileController@add']);

Route::get('/test', ['as' => 'loan.print', function () {
	return view('members.transactions');
}]);
