<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class reports extends TestCase{

	/**
	 * A testReportsfilter functional.
	 *
	 * @return void
	 */
	public function testReportsfilter()
	{
	    $this->get('reports/filter')
	         ->seePageIs('reports/filter');
	}

	/**
	 * A testReportsindex functional.
	 *
	 * @return void
	 */
	public function testReportsindex()
	{
	    $this->get('reports')
	         ->seePageIs('reports');
	}

	/**
	 * A testReportsmemberscontractssaving functional.
	 *
	 * @return void
	 */
	public function testReportsmemberscontractssaving()
	{
	    $this->get('reports/members/contracts/saving/1/2')
	         ->seePageIs('reports/members/contracts/saving/');
	}

	/**
	 * A testReportsmemberscontractsloan functional.
	 *
	 * @return void
	 */
	public function testReportsmemberscontractsloan()
	{
	    $this->get('reports/members/contracts/loan/1/2')
	         ->seePageIs('reports/members/contracts/loan/');
	}

	/**
	 * A testReportsmemberscontractsordinaryloan functional.
	 *
	 * @return void
	 */
	public function testReportsmemberscontractsordinaryloan()
	{
	    $this->get('reports/members/contracts/ordinaryloan/1')
	         ->seePageIs('reports/members/contracts/ordinaryloan/');
	}

	/**
	 * A testReportsmemberscontractssocialloan functional.
	 *
	 * @return void
	 */
	public function testReportsmemberscontractssocialloan()
	{
	    $this->get('reports/members/contracts/socialloan/1')
	         ->seePageIs('reports/members/contracts/socialloan/');
	}

	/**
	 * A testReportsmembersloanrecords functional.
	 *
	 * @return void
	 */
	public function testReportsmembersloanrecords()
	{
	    $this->get('reports/members/loanrecords/1/2/3/4')
	         ->seePageIs('reports/members/loanrecords/');
	}

	/**
	 * A testReportsmemberscontributions functional.
	 *
	 * @return void
	 */
	public function testReportsmemberscontributions()
	{
	    $this->get('reports/members/contributions/1/2/3/4')
	         ->seePageIs('reports/members/contributions/');
	}

	/**
	 * A testReportsaccountingpiece functional.
	 *
	 * @return void
	 */
	public function testReportsaccountingpiece()
	{
	    $this->get('reports/accounting/piece/1/2/3')
	         ->seePageIs('reports/accounting/piece/');
	}

	/**
	 * A testReportsaccountingledger functional.
	 *
	 * @return void
	 */
	public function testReportsaccountingledger()
	{
	    $this->get('reports/accounting/ledger/1/2/3/4')
	         ->seePageIs('reports/accounting/ledger/');
	}

	/**
	 * A testReportsaccountingbilan functional.
	 *
	 * @return void
	 */
	public function testReportsaccountingbilan()
	{
	    $this->get('reports/accounting/bilan/1/2/3')
	         ->seePageIs('reports/accounting/bilan/');
	}

	/**
	 * A testReportsaccountingjournal functional.
	 *
	 * @return void
	 */
	public function testReportsaccountingjournal()
	{
	    $this->get('reports/accounting/journal/1/2/3')
	         ->seePageIs('reports/accounting/journal/');
	}

	/**
	 * A testReportsaccountingaccounts functional.
	 *
	 * @return void
	 */
	public function testReportsaccountingaccounts()
	{
	    $this->get('reports/accounting/accounts/1')
	         ->seePageIs('reports/accounting/accounts/');
	}

	/**
	 * A testPiecedisbursedsaving functional.
	 *
	 * @return void
	 */
	public function testPiecedisbursedsaving()
	{
	    $this->get('reports/piece/disbursed/saving/1/2')
	         ->seePageIs('reports/piece/disbursed/saving/');
	}

	/**
	 * A testPiecedisbursedaccounting functional.
	 *
	 * @return void
	 */
	public function testPiecedisbursedaccounting()
	{
	    $this->get('reports/piece/disbursed/accounting/1}')
	         ->seePageIs('reports/piece/disbursed/accounting/');
	}

	/**
	 * A testPiecedisbursedaccount functional.
	 *
	 * @return void
	 */
	public function testPiecedisbursedaccount()
	{
	    $this->get('reports/piece/disbursed/loan/1/2')
	         ->seePageIs('reports/piece/disbursed/loan/');
	}

	/**
	 * A testPiecedisbursedrefund functional.
	 *
	 * @return void
	 */
	public function testPiecedisbursedrefund()
	{
	    $this->get('reports/piece/disbursed/refund/1/2')
	         ->seePageIs('reports/piece/disbursed/refund/');
	}

	/**
	 * A testReportscautionsme functional.
	 *
	 * @return void
	 */
	public function testReportscautionsme()
	{
	    $this->get('reports/cautions/cautioned_me/1/2/3/4')
	         ->seePageIs('reports/cautions/cautioned_me/');
	}

	/**
	 * A testReportsloans functional.
	 *
	 * @return void
	 */
	public function testReportsloans()
	{
	    $this->get('reports/cautions/cautioned_by_me/1/2/3/4')
	         ->seePageIs('reports/cautions/cautioned_by_me/');
	}

	/**
	 * A testReportsloansbalance functional.
	 *
	 * @return void
	 */
	public function testReportsloansbalance()
	{
	    $this->get('reports/loans/balance/undefined/1')
	         ->seePageIs('reports/loans/balance/undefined/');
	}

	/**
	 * A testReportsloansstatus functional.
	 *
	 * @return void
	 */
	public function testReportsloansstatus()
	{
	    $this->get('reports/loans/1/2/3/4')
	         ->seePageIs('reports/loans/');
	}

	/**
	 * A testReportsrefundsmonthly functional.
	 *
	 * @return void
	 */
	public function testReportsrefundsmonthly()
	{
	    $this->get('reports/refunds/monthly/1/2')
	         ->seePageIs('reports/refunds/monthly/');
	}

	/**
	 * A testReportsrefundsirreguralities functional.
	 *
	 * @return void
	 */
	public function testReportsrefundsirreguralities()
	{
	    $this->get('reports/refunds/irreguralities/1/2')
	         ->seePageIs('reports/refunds/irreguralities/');
	}

	/**
	 * A testReportssavingslevel functional.
	 *
	 * @return void
	 */
	public function testReportssavingslevel()
	{
	    $this->get('reports/savings/level/1/2')
	         ->seePageIs('reports/savings/level/');
	}

	/**
	 * A testReportscontributionnotcontributing functional.
	 *
	 * @return void
	 */
	public function testReportscontributionnotcontributing()
	{
	    $this->get('reports/contributions/notcontribuing/1/2')
	         ->seePageIs('reports/contributions/notcontribuing/');
	}
}
?>