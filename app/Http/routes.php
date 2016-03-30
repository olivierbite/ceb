<?php

use Ceb\Models\Setting;
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
	Route::get('/{memberId}/refund'					,['as'=>'members.refund' , 'uses'=>'MemberController@refund']);
	Route::get('/{memberId}/contribute'				,['as'=>'members.contribute' , 'uses'=>'MemberController@contribute']);
	Route::get('/{memberId}/transacts'				,['as'=>'members.transacts','uses'=>'MemberController@transacts']);
	Route::post('/{memberId}/completetransaction'	,['as'=>'members.completetransaction','uses'=>'MemberController@completeTransaction']);
	Route::get('/{memberId}/attornies'				,['as'=>'members.attornies','uses'=>'MemberController@attornies']);
	Route::get('/loanrecords/{memberId}'			,['as'=>'members.loanrecords','uses'=>'MemberController@loanRecords']);
	Route::get('/contributions/{memberId}'			,['as'=>'members.contributions','uses'=>'MemberController@contributions']);
	Route::get('/cautions/{memberid}'				,['as'=>'members.cautions.actives','uses'=>'MemberController@currentCautions']);
	Route::get('/cautioned/{memberid}'				,['as'=>'members.cautioned.actives','uses'=>'MemberController@currentCautionedByMe']);
	
});
Route::resource('members', 'MemberController');

/** Attornies routes */
Route::resource('attornies','AttorneyController');

/** Contribution routes */
Route::group(['prefix'=>'contributions'], function(){
	Route::post('complete'				,['as'=>'contributions.complete', 'uses'=>'ContributionAndSavingsController@complete']);
	Route::get('cancel'					,['as'=>'contributions.cancel', 'uses'=>'ContributionAndSavingsController@cancel']);	
	Route::post('batch'					,['as'=>'contributions.batch', 'uses'=>'ContributionAndSavingsController@batch']);
	Route::get('{adhersion_id}/remove'	,['as'=>'contributions.remove.member','uses'=>'ContributionAndSavingsController@removeMember']);
	Route::get('samplecsv'				,['as'=>'contributions.sample.csv','uses'=>'ContributionAndSavingsController@downloadSample']);
});

Route::resource('contributions', 'ContributionAndSavingsController');


//Loan Routets
Route::group(['prefix'=>'loans'], function(){

	Route::get('/{id}', 'LoanController@selectMember')->where('id', '[0-9]+');
	Route::get('/cancel', ['as'						=>'loan.cancel', 'uses' => 'LoanController@cancel']);
	Route::get('/complete', ['as'					=> 'loan.complete', 'uses' => 'LoanController@complete']);
	Route::post('/complete', ['as'					=> 'loan.complete', 'uses' => 'LoanController@complete']);
	Route::get('/setcautionneur', ['as'				=> 'loan.add.cautionneur', 'uses' => 'LoanController@setCautionneur']);
	Route::get('/pending/{loanId?}', ['as'			=> 'loan.pending', 'uses' => 'LoanController@getPending']);
	Route::get('/blocked/{loanId?}', ['as'			=> 'loan.blocked', 'uses' => 'LoanController@getBlocked']);
	Route::get('/process/{loanId}/{status}', ['as'	=> 'loan.process', 'uses' => 'LoanController@process']);
	Route::any('/unlblock', ['as'					=> 'loan.unblock.store', 'uses' =>'LoanController@unblock']);
	Route::get('/unblock/form/{loanId?}', ['as'		=> 'loan.unblock.form', 'uses' => 'LoanController@showUnblockingForm']);

	Route::get('/remove/cautionneur/{cautionneur}',
							  ['as'=> 'loan.remove.cautionneur',
						       'uses' => 'loanController@removeCautionneur']
				)->where('cautionneur', '[A-Za-z0-9]+');

});
Route::resource('loans', 'LoanController');

	/** REGULARISATION ROUTES */
	Route::group(['prefix'=>'regularisation'], function(){
		Route::get('/'				,['as' => 'regularisation.index', 'uses' => 'RegularisationController@index']);
		Route::get('/{id}'			,['as' => 'regularisation.setmember', 'uses' => 'RegularisationController@selectMember'])->where('id', '[0-9]+');
		Route::get('/setcautionneur',['as' => 'regularisation.add.cautionneur', 'uses' => 'RegularisationController@setCautionneur']);
		Route::get('/cancel'		,['as' => 'regularisation.cancel', 'uses' => 'RegularisationController@cancel']);
		Route::post('/complete'		,['as' => 'regularisation.complete', 'uses' => 'RegularisationController@complete']);
		Route::get('/remove/cautionneur/{cautionneur}',
							  ['as'=> 'regularisation.remove.cautionneur',
						       'uses' => 'RegularisationController@removeCautionneur']
				)->where('cautionneur', '[A-Za-z0-9]+');
	});

	/** Refunds routes */
	Route::group(['prefix'=>'refunds'], function()
	{
		Route::post('/complete', ['as'	=> 'refunds.complete', 'uses' => 'RefundController@complete']);
		Route::get('/cancel', ['as'		=> 'refunds.cancel', 'uses' => 'RefundController@cancel']);
		Route::get('{adhersion_id}/remove'	,['as'=>'refunds.remove.member','uses'=>'RefundController@removeMember']);
	});
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
		Route::get('contracts/saving/{memberId}/{export_excel?}', ['as'				=> 'reports.members.contracts.saving', 'uses' => 'ReportController@contractSaving']);
		Route::get('contracts/loan/{loanId}/{export_excel?}', ['as'					=> 'reports.members.contracts.loan', 'uses' => 'ReportController@contractLoan']);
		Route::get('contracts/ordinaryloan/{export_excel?}', ['as'					=> 'reports.members.contracts.ordinaryloan', 'uses' => 'ReportController@ordinaryloan']);
		Route::get('contracts/socialloan/{export_excel?}', ['as'					=> 'reports.members.contracts.socialloan', 'uses' => 'ReportController@socialloan']);
		
		// FILES
		Route::get('loanrecords/{startDate}/{endDate}/{export_excel?}/{memberId}'	,['as'=>'reports.members.loanrecords','uses'=>'ReportController@loanRecords']);
		Route::get('contributions/{startDate}/{endDate}/{export_excel?}/{memberId}'	,['as'=>'reports.members.contributions','uses'=>'ReportController@contributions']);

	});

	// ACOUNTING REPORTS 
	Route::group(['prefix'=>'accounting'], function()
	{
		Route::get('piece/{startDate}/{endDate}/{export_excel?}'	,['as' => 'reports.accounting.piece', 'uses' => 'ReportController@accountingPiece']);
		Route::get('ledger/{startDate}/{endDate}/{accountid}/{export_excel?}'	,['as'=>'reports.accounting.ledger','uses'=>'ReportController@ledger']);
		Route::get('bilan/{startDate}/{endDate}/{export_excel?}'	,['as'=>'reports.accounting.bilan','uses'=>'ReportController@bilan']);
		Route::get('journal/{startDate}/{endDate}/{export_excel?}'	,['as'=>'reports.accounting.journal','uses'=>'ReportController@journal']);
		Route::get('accounts/{export_excel?}'						,['as'=>'reports.accounting.accounts','uses'=>'ReportController@accountsList']);
	});

	// PIECES REPORTS 
	Route::group(['prefix'=>'piece'], function()
	{
			Route::group(['prefix'=>'disbursed'], function()
			{
				Route::get('saving/{transactionid}/{export_excel?}',['as'=>'piece.disbursed.saving','uses'=>'ReportController@pieceDisbursedSaving']);
				Route::get('accounting/{transactionid}}',['as'=>'piece.disbursed.accounting','uses'=>'ReportController@pieceDisbursedAccounting']);
				Route::get('account/{startDate}/{endDate}/{account}/{export_excel?}',['as'=>'piece.disbursed.account','uses'=>'ReportController@pieceDisbursedAccount']);
				Route::get('loan/{transactionid}/{export_excel?}',['as'=>'piece.disbursed.account','uses'=>'ReportController@pieceDisbursedLoan']);
				Route::get('refund/{transactionid}/{export_excel?}',['as'=>'piece.disbursed.refund','uses'=>'ReportController@pieceDisbursedRefund']);
		});
	});
	// CAUTIONS REPORTS 
	Route::group(['prefix'=>'cautions'], function()
	{
		Route::get('/cautioned_me/{startDate}/{endDate}/{export_excel?}/{memberId}', ['as'=>'reports.cautions.me','uses'=>'ReportController@cautionedMe']);
		Route::get('/cautioned_by_me/{startDate}/{endDate}/{export_excel?}/{memberId}', ['as'=>'reports.loans','uses'=>'ReportController@cautionedByMe']);

	});
	// LOANS REPORTS 
	Route::group(['prefix'=>'loans'], function()
	{

		Route::get('/balance/undefined/{export_excel?}', ['as'=>'reports.loans.balance','uses'=>'ReportController@loansBalance']);
		Route::get('/{startDate}/{endDate}/{status}/{export_excel?}', ['as'=>'reports.loans.status','uses'=>'ReportController@loans']);
	});
	// LOANS REPORTS 
	Route::group(['prefix'=>'refunds'], function()
	{
		Route::get('monthly/{institution}/{export_excel?}', ['as'=>'reports.refunds.monthly','uses'=>'ReportController@montlyRefund']);
		Route::get('irreguralities/{institution?}/{export_excel?}', ['as'=>'reports.refunds.irreguralities','uses'=>'ReportController@refundIrregularities']);
	});
    // LOANS REPORTS 
	Route::group(['prefix'=>'savings'], function()
	{
		Route::get('level/{institution?}/{export_excel?}', ['as'=>'reports.savings.level','uses'=>'ReportController@savingsLevel']);
	});
	 // LOANS REPORTS 
	Route::group(['prefix'=>'contributions'], function()
	{
		Route::get('notcontribuing/{institution?}/{export_excel?}', ['as'=>'reports.contribution.not.contributing','uses'=>'ReportController@notContribuing']);
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

	Route::get('/regularisation', 'RegularisationController@ajaxFieldUpdate');
	Route::post('/regularisation/accounting', ['as' => 'ajax.accounting', 'uses' => 'RegularisationController@ajaxAccountingFeilds']);

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
Route::group(array('prefix'	=> '/items'), function() {
	Route::get('/', ['as'				=> 'items.index','uses'=>'ItemsController@index']);
	Route::any('/add', ['as'			=> 'items.add','uses'=>'ItemsController@add']);
	Route::any('/edit/{id}', ['as'		=> 'items.edit','uses'=>'ItemsController@edit'])->where('id', '[0-9]+');
	Route::get('/delete/{id}', ['as'	=> 'items.delete','uses'=>'ItemsController@delete'])->where('id', '[0-9]+');
});

/** DYNAMIC ASSETS ROUTES */
$router->get('/js/loanform',['as'=>'assets.js.loanform','uses'=>function(){
	return response()->view('assets.js.loan_formjs')->header('Content-Type','application/javascript; charset=utf-8');
}]);
$router->get('/js/regularisationform',['as'=>'assets.js.regularisationform','uses'=>function(){
	return response()->view('assets.js.regularisation_formjs')->header('Content-Type','application/javascript; charset=utf-8');;
}]);

/** ROUTE FOR LOGS */
Route::get('logs', ['as'=>'logs','middleware'=>'sentry.admin','uses'=>'\Rap2hpoutre\LaravelLogViewer\LogViewerController@index']);


/** TESTING ROUTES */
Route::get('/pdf', function(){

$routes = (new Ceb\Generators\TestsGenerators)->writeTestClass();
$routeCollection = Route::getRoutes();

echo "<table style='width:100%'>";
    echo "<tr>";
        echo "<td width='10%'><h4>HTTP Method</h4></td>";
        echo "<td width='10%'><h4>Route</h4></td>";
        echo "<td width='80%'><h4>Corresponding Action</h4></td>";
    echo "</tr>";
    foreach ($routeCollection as $value) {
        echo "<tr>";
            echo "<td>" . $value->getMethods()[0] . "</td>";
            echo "<td>" . $value->getPath() . "</td>";
            echo "<td>" . $value->getActionName() . "</td>";
        echo "</tr>";
    }
echo "</table>";
});
