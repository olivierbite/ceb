<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class loans extends TestCase{

	/**
	 * A testLoansid functional.
	 *
	 * @return void
	 */
	public function testLoansid()
	{
	    $this->get('loans/1')
	         ->seePageIs('loans/');
	}

	/**
	 * A testLoancancel functional.
	 *
	 * @return void
	 */
	public function testLoancancel()
	{
	    $this->get('loans/cancel')
	         ->seePageIs('loans/cancel');
	}

	/**
	 * A testLoancomplete functional.
	 *
	 * @return void
	 */
	public function testLoancomplete()
	{
	    $this->post('loans/complete')
	         ->seePageIs('loans/complete');
	}

	/**
	 * A testLoanaddcautionneur functional.
	 *
	 * @return void
	 */
	public function testLoanaddcautionneur()
	{
	    $this->get('loans/setcautionneur')
	         ->seePageIs('loans/setcautionneur');
	}

	/**
	 * A testLoanpending functional.
	 *
	 * @return void
	 */
	public function testLoanpending()
	{
	    $this->get('loans/pending/1')
	         ->seePageIs('loans/pending/');
	}

	/**
	 * A testLoanblocked functional.
	 *
	 * @return void
	 */
	public function testLoanblocked()
	{
	    $this->get('loans/blocked/1')
	         ->seePageIs('loans/blocked/');
	}

	/**
	 * A testLoanprocess functional.
	 *
	 * @return void
	 */
	public function testLoanprocess()
	{
	    $this->get('loans/process/1/2')
	         ->seePageIs('loans/process/');
	}

	/**
	 * A testLoanunblockstore functional.
	 *
	 * @return void
	 */
	public function testLoanunblockstore()
	{
	    $this->get('loans/unlblock')
	         ->seePageIs('loans/unlblock');
	}

	/**
	 * A testLoanunblockform functional.
	 *
	 * @return void
	 */
	public function testLoanunblockform()
	{
	    $this->get('loans/unblock/form/1')
	         ->seePageIs('loans/unblock/form/');
	}

	/**
	 * A testLoanremovecautionneur functional.
	 *
	 * @return void
	 */
	public function testLoanremovecautionneur()
	{
	    $this->get('loans/remove/cautionneur/1')
	         ->seePageIs('loans/remove/cautionneur/');
	}

	/**
	 * A testLoansindex functional.
	 *
	 * @return void
	 */
	public function testLoansindex()
	{
	    $this->get('loans')
	         ->seePageIs('loans');
	}

	/**
	 * A testLoanscreate functional.
	 *
	 * @return void
	 */
	public function testLoanscreate()
	{
	    $this->get('loans/create')
	         ->seePageIs('loans/create');
	}

	/**
	 * A testLoansstore functional.
	 *
	 * @return void
	 */
	public function testLoansstore()
	{
	    $this->post('loans')
	         ->seePageIs('loans');
	}

	/**
	 * A testLoansshow functional.
	 *
	 * @return void
	 */
	public function testLoansshow()
	{
	    $this->get('loans/1')
	         ->seePageIs('loans/');
	}

	/**
	 * A testLoansedit functional.
	 *
	 * @return void
	 */
	public function testLoansedit()
	{
	    $this->get('loans/1/edit')
	         ->seePageIs('loans/');
	}

	/**
	 * A testLoansupdate functional.
	 *
	 * @return void
	 */
	public function testLoansupdate()
	{
	    $this->put('loans/1')
	         ->seePageIs('loans/');
	}

	/**
	 * A testLoansloans functional.
	 *
	 * @return void
	 */
	public function testLoansloans()
	{
	    $this->patch('loans/1')
	         ->seePageIs('loans/');
	}

	/**
	 * A testLoansdestroy functional.
	 *
	 * @return void
	 */
	public function testLoansdestroy()
	{
	    $this->delete('loans/1')
	         ->seePageIs('loans/');
	}
}
?>