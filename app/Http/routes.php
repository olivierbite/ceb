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


// NOTIFICATIONS
Route::get('notifications',['as'=>'notificatons','uses'=>'MemberController@notificatons']);

/** Members routes */
Route::group(['prefix'=>'members'], function(){
	Route::get('/search', 'MemberController@search');
	Route::get('/{memberId}/refund',['as' => 'members.refund' , 'uses'=> 'MemberController@refund']);
	Route::get('/{memberId}/contribute',['as' => 'members.contribute' , 'uses'=> 'MemberController@contribute']);
	Route::get('/{memberId}/transacts',['as'=>'members.transacts','uses'=>'MemberController@transacts']);
	Route::post('/{memberId}/completetransaction',['as'=>'members.completetransaction','uses'=>'MemberController@completeTransaction']);
	Route::get('/{memberId}/attornies',['as'=>'members.attornies','uses'=>'MemberController@attornies']);
	Route::get('/loanrecords/{memberId}',['as'=>'members.loanrecords','uses'=>'MemberController@loanRecords']);
	Route::get('/contributions/{memberId}',['as'=>'members.contributions','uses'=>'MemberController@contributions']);
});
Route::resource('members', 'MemberController');

/** Attornies routes */
Route::resource('attornies','AttorneyController');

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
Route::group(['prefix'=>'loans'], function(){

	Route::get('/{id}', 'LoanController@selectMember')->where('id', '[0-9]+');
	Route::get('/cancel', ['as' => 'loan.cancel', 'uses' => 'LoanController@cancel']);
	Route::get('/complete', ['as' => 'loan.complete', 'uses' => 'loanController@complete']);
	Route::post('/complete', ['as' => 'loan.complete', 'uses' => 'loanController@complete']);
	Route::get('/setcautionneur', ['as' => 'loan.add.cautionneur', 'uses' => 'loanController@setCautionneur']);
	Route::get('/status/{transactionId}', ['as' => 'loan.status', 'uses' => 'loanController@status']);
	Route::get('/remove/cautionneur/{cautionneur}',
							  ['as' => 'loan.remove.cautionneur',
						       'uses' => 'loanController@removeCautionneur']
				)->where('cautionneur', '[A-Za-z0-9]+');

});

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
	Route::get('/filter',['as'=>'reports.filter','uses'=>'ReportFilterController@filter']);
	Route::get('/', ['as' => 'reports.index', 'uses' => 'ReportController@index']);

	// ACOUNTING REPORTS 
	Route::group(['prefix'=>'accounting'], function()
	{
		Route::get('piece/{startDate}/{endDate}/{export_excel}',['as' => 'reports.accounting.piece', 'uses' => 'ReportController@accountingPiece']);
		Route::get('ledger/{startDate}/{endDate}/{export_excel}',['as'=>'reports.accounting.ledger','uses'=>'ReportController@ledger']);
		Route::get('bilan/{startDate}/{endDate}/{export_excel}',['as'=>'reports.accounting.bilan','uses'=>'ReportController@bilan']);
		Route::get('journal/{startDate}/{endDate}/{export_excel}',['as'=>'reports.accounting.journal','uses'=>'ReportController@journal']);
		Route::get('accounts/{export_excel}',['as'=>'reports.accounting.accounts','uses'=>'ReportController@accountsList']);
	});

	// ACOUNTING REPORTS 
	Route::group(['prefix'=>'members'], function()
	{
		// CONTRACTS
		Route::get('contracts/saving/{memberId}/{export_excel}', ['as' => 'reports.members.contracts.saving', 'uses' => 'ReportController@contractSaving']);
		Route::get('contracts/loan/{loanId}/{export_excel}', ['as' => 'reports.members.contracts.loan', 'uses' => 'ReportController@contractLoan']);
		Route::get('contracts/ordinaryloan/{export_excel}', ['as' => 'reports.members.contracts.ordinaryloan', 'uses' => 'ReportController@ordinaryloan']);
		Route::get('contracts/socialloan/{export_excel}', ['as' => 'reports.members.contracts.socialloan', 'uses' => 'ReportController@socialloan']);
		
		// FILES
		Route::get('loanrecords/{startDate}/{endDate}/{export_excel}/{memberId}',['as'=>'reports.members.loanrecords','uses'=>'ReportController@loanRecords']);
		Route::get('contributions/{startDate}/{endDate}/{export_excel}/{memberId}',['as'=>'reports.members.contributions','uses'=>'ReportController@contributions']);

	});

});

/**
 * LEAVES ROUTES
 */
	Route::group(array('prefix' => 'leaves'), function() {

	    Route::get('/request', array('as' => 'leaves.request', 'uses' => 'LeaveController@create'));
	    Route::get('/show', array('as' => 'leaves.show', 'uses' => 'LeaveController@show'));
	    Route::get('/pending', array('as' => 'leaves.pending', 'uses' => 'LeaveController@index'));
	    Route::get('/approve/{leave}', array('as' => 'leaves.approve', 'uses' => 'LeaveController@approve'));
	    Route::get('reject/{leave}', array('as' => 'leaves.reject', 'uses' => 'LeaveController@reject'));
	    Route::get('status/{leave}', array('as' => 'leaves.status', 'uses' => 'LeaveController@status'));
});
Route::resource('leaves', 'LeaveController',['only' => ['index', 'store','create']]);

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
Route::get('files/get/{filename?}', [
	'as' => 'files.get', 'uses' => 'FileController@get']);
Route::post('files/add', [
	'as' => 'files.add', 'uses' => 'FileController@add']);


/** SENTINEL ROUTES */
Route::get('settings/users', ['as' => 'ceb.settings.users.index', 'uses' => 'UserController@index']);


$router->get('/test/{start?}/{end?}',function($start=1,$end=12)
	{
		// Display all SQL executed in Eloquent
		$rates = Ceb\Models\MemberLoanCautionneur::byTransaction('2015110621381')
												->byAdhersion('20070032')
												->byLoanId('138266')
												->Active()
												->get();
		
		foreach ($rates as $rate) {
			$rate->refunded_amount = 1000;
			dd($rate->save());
		}
	});