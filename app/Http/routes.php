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
	Route::get('/cautions/{memberid}', ['as' => 'members.cautions.actives','uses' =>'MemberController@currentCautions']);
	Route::get('/cautioned/{memberid}', ['as' => 'members.cautioned.actives','uses' =>'MemberController@currentCautionedByMe']);
	
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
	Route::get('/complete', ['as' => 'loan.complete', 'uses' => 'LoanController@complete']);
	Route::post('/complete', ['as' => 'loan.complete', 'uses' => 'LoanController@complete']);
	Route::get('/setcautionneur', ['as' => 'loan.add.cautionneur', 'uses' => 'LoanController@setCautionneur']);
	Route::get('/pending/{loanId?}', ['as' => 'loan.pending', 'uses' => 'LoanController@getPending']);
	Route::get('/process/{loanId}/{status}', ['as' => 'loan.process', 'uses' => 'LoanController@process']);

	Route::get('/remove/cautionneur/{cautionneur}',
							  ['as'=> 'loan.remove.cautionneur',
						       'uses' => 'loanController@removeCautionneur']
				)->where('cautionneur', '[A-Za-z0-9]+');

});
Route::resource('loans', 'LoanController');

	/** regularisation */
	$regularisationsTypes = (new Ceb\ViewComposers\RegularisactionViewComposer)->getRegularisationTypes();
	foreach ($regularisationsTypes as $key => $value) 
	{
	 Route::get('regularisation/type/'.$key, ['as'=>'regularisation.type.'.$key,'uses'=>'RegularisationController@index']);
	}
	Route::post('regularisation/regulate', ['as'=>'regularisation.regulate','uses'=>'RegularisationController@regulate']);
	Route::get('regularisation/types', ['as'=>'regularisation.types','uses'=>'RegularisationController@regurationTypes']);
	Route::resource('regularisation', 'RegularisationController');

	/** Refunds routes */
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
	Route::group(['prefix'=>'members'], function()
	{
		// CONTRACTS
		Route::get('contracts/saving/{memberId}/{export_excel?}', ['as' => 'reports.members.contracts.saving', 'uses' => 'ReportController@contractSaving']);
		Route::get('contracts/loan/{loanId}/{export_excel?}', ['as' => 'reports.members.contracts.loan', 'uses' => 'ReportController@contractLoan']);
		Route::get('contracts/ordinaryloan/{export_excel?}', ['as' => 'reports.members.contracts.ordinaryloan', 'uses' => 'ReportController@ordinaryloan']);
		Route::get('contracts/socialloan/{export_excel?}', ['as' => 'reports.members.contracts.socialloan', 'uses' => 'ReportController@socialloan']);
		
		// FILES
		Route::get('loanrecords/{startDate}/{endDate}/{export_excel?}/{memberId}',['as'=>'reports.members.loanrecords','uses'=>'ReportController@loanRecords']);
		Route::get('contributions/{startDate}/{endDate}/{export_excel?}/{memberId}',['as'=>'reports.members.contributions','uses'=>'ReportController@contributions']);

	});

	// ACOUNTING REPORTS 
	Route::group(['prefix'=>'accounting'], function()
	{
		Route::get('piece/{startDate}/{endDate}/{export_excel?}',['as' => 'reports.accounting.piece', 'uses' => 'ReportController@accountingPiece']);
		Route::get('ledger/{startDate}/{endDate}/{export_excel?}',['as'=>'reports.accounting.ledger','uses'=>'ReportController@ledger']);
		Route::get('bilan/{startDate}/{endDate}/{export_excel?}',['as'=>'reports.accounting.bilan','uses'=>'ReportController@bilan']);
		Route::get('journal/{startDate}/{endDate}/{export_excel?}',['as'=>'reports.accounting.journal','uses'=>'ReportController@journal']);
		Route::get('accounts/{export_excel?}',['as'=>'reports.accounting.accounts','uses'=>'ReportController@accountsList']);
	});

	// PIECES REPORTS 
	Route::group(['prefix'=>'piece'], function()
	{
			Route::group(['prefix'=>'disbursed'], function()
			{
				Route::get('saving/{startDate}/{endDate}/{export_excel?}',['as'=>'piece.disbursed.saving','uses'=>'ReportController@pieceDisbursedSaving']);
				Route::get('account/{startDate}/{endDate}/{export_excel?}',['as'=>'piece.disbursed.account','uses'=>'ReportController@pieceDisbursedAccount']);
				Route::get('loan/{startDate}/{endDate}/{export_excel?}',['as'=>'piece.disbursed.account','uses'=>'ReportController@pieceDisbursedLoan']);
			});
	});

	// LOANS REPORTS 
	Route::group(['prefix'=>'loans'], function()
	{
		Route::get('/{startDate}/{endDate}/{status}/{export_excel?}', ['as'=>'reports.loans','uses'=>'ReportController@loans']);
	});
	
});

	/**LEAVES ROUTES*/
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
	Route::post('/loans/accounting', ['as' => 'ajax.accounting', 'uses' => 'LoanController@ajaxAccountingFeilds']);
});

/** Files routes */
Route::get('files', 'FileController@index');
Route::get('files/get/{filename?}', [
	'as' => 'files.get', 'uses' => 'FileController@get']);
Route::post('files/add', [
	'as' => 'files.add', 'uses' => 'FileController@add']);


/** SENTINEL ROUTES */
Route::get('settings/users', ['as' => 'ceb.settings.users.index', 'uses' => 'UserController@index']);

/** UTILITY ROUTES */
$router->get('/utility/backup',['as'=>'utility.backup','uses'=>'UtilityController@backup']);

/**  ITEMS INVENTORY management group */
Route::group(array('prefix' => '/items'), function() {
    Route::get('/', ['as' => 'items.index','uses'=>'ItemsController@index']);
    Route::any('/add', ['as' => 'items.add','uses'=>'ItemsController@add']);
    Route::any('/edit/{id}', ['as' => 'items.edit','uses'=>'ItemsController@edit'])->where('id', '[0-9]+');
    Route::get('/delete/{id}', ['as' => 'items.delete','uses'=>'ItemsController@delete'])->where('id', '[0-9]+');
});

$router->get('/test/{start?}/{end?}',function($start=1,$end=12)
	{
	
   });