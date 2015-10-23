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

Route::get('/', ['as' => 'home','uses'=>'HomeController@index']);

/** Members routes */
Route::get('members/search', 'MemberController@search');
Route::resource('members', 'MemberController');
Route::resource('attornies','AttorneyController');
Route::get('/members/{memberId}/refund',['as' => 'members.refund' , 'uses'=> 'MemberController@refund']);
Route::get('/members/{memberId}/contribute',['as' => 'members.contribute' , 'uses'=> 'MemberController@contribute']);
Route::get('/members/{memberId}/transacts',['as'=>'members.transacts','uses'=>'MemberController@transacts']);
Route::post('/members/{memberId}/completetransaction',['as'=>'members.completetransaction','uses'=>'MemberController@completeTransaction']);
Route::get('/members/{memberId}/attornies',['as'=>'members.attornies','uses'=>'MemberController@attornies']);
Route::get('/members/{memberId}/loanrecords',['as'=>'members.loanrecords','uses'=>'MemberController@loanRecords']);
Route::get('/members/{memberId}/contributions',['as'=>'members.contributions','uses'=>'MemberController@contributions']);


/** Contribution routes */
Route::group(['prefix'=>'contributions'], function(){
	Route::post('complete', ['as' => 'contributions.complete', 'uses' => 'ContributionAndSavingsController@complete']);
	Route::get('cancel', ['as' => 'contributions.cancel', 'uses' => 'ContributionAndSavingsController@cancel']);	
	Route::post('batch', ['as' => 'contributions.batch', 'uses' => 'ContributionAndSavingsController@batch']);
	Route::get('{adhersion_id}/remove',['as'=>'contributions.remove.member','uses'=>'ContributionAndSavingsController@removeMember']);
	Route::get('samplecsv',['as'=>'contributions.sample.csv','uses'=>'ContributionAndSavingsController@downloadSample']);
});

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
Route::group(['prefix'=>'reports'], function(){	

	/** REPORT FILTERS */
	Route::get('/datefilter',['as'=>'reports.date.filter','uses'=>'ReportFilterController@dateFilter']);
	Route::get('/memberfilter',['as'=>'reports.member.filter','uses'=>'ReportFilterController@memberFilter']);

	Route::get('/', ['as' => 'reports.index', 'uses' => 'ReportController@index']);
	Route::get('/contracts/saving/{memberId}', ['as' => 'reports.contracts.saving', 'uses' => 'ReportController@contractSaving']);
	Route::get('/contracts/loan/{loanId}', ['as' => 'reports.contracts.loan', 'uses' => 'ReportController@contractLoan']);
	Route::get('/contracts/ordinaryloan', ['as' => 'reports.contracts.ordinaryloan', 'uses' => 'ReportController@ordinaryloan']);
	Route::get('/contracts/socialloan', ['as' => 'reports.contracts.socialloan', 'uses' => 'ReportController@socialloan']);

	// ACOUNTING REPORTS 
	Route::group(['prefix'=>'accounting'], function()
	{
		Route::get('piece/{startDate}/{endDate}',['as' => 'reports.accounting.piece', 'uses' => 'ReportController@accountingPiece']);
		Route::get('ledger/{startDate}/{endDate}',['as'=>'reports.accounting.ledger','uses'=>'ReportController@ledger']);
		Route::get('bilan/{startDate}/{endDate}',['as'=>'reports.accounting.bilan','uses'=>'ReportController@bilan']);
		Route::get('journal/{startDate}/{endDate}',['as'=>'reports.accounting.journal','uses'=>'ReportController@journal']);
		Route::get('accounts',['as'=>'reports.accounting.accounts','uses'=>'ReportController@accountsList']);
	});
});

/** SETTINGS ROUTE */
Route::group(['prefix'=>'settings'], function(){
	Route::resource('institution', 'InstitutionController');
	Route::resource('accountingplan', 'AccountController');
});

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


Route::get('/test',function(){
	dd(Ceb\Models\Account::first()->debit_amount);
});