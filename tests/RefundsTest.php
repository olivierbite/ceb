<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class refunds extends TestCase{

	/**
	 * A testRefundscomplete functional.
	 *
	 * @return void
	 */
	public function testRefundscomplete()
	{
	    $this->post('refunds/complete')
	         ->seePageIs('refunds/complete');
	}

	/**
	 * A testRefundscancel functional.
	 *
	 * @return void
	 */
	public function testRefundscancel()
	{
	    $this->get('refunds/cancel')
	         ->seePageIs('refunds/cancel');
	}

	/**
	 * A testRefundsremovemember functional.
	 *
	 * @return void
	 */
	public function testRefundsremovemember()
	{
	    $this->get('refunds/1/remove')
	         ->seePageIs('refunds/');
	}

	/**
	 * A testRefundsindex functional.
	 *
	 * @return void
	 */
	public function testRefundsindex()
	{
	    $this->get('refunds')
	         ->seePageIs('refunds');
	}

	/**
	 * A testRefundscreate functional.
	 *
	 * @return void
	 */
	public function testRefundscreate()
	{
	    $this->get('refunds/create')
	         ->seePageIs('refunds/create');
	}

	/**
	 * A testRefundsstore functional.
	 *
	 * @return void
	 */
	public function testRefundsstore()
	{
	    $this->post('refunds')
	         ->seePageIs('refunds');
	}

	/**
	 * A testRefundsshow functional.
	 *
	 * @return void
	 */
	public function testRefundsshow()
	{
	    $this->get('refunds/1')
	         ->seePageIs('refunds/');
	}

	/**
	 * A testRefundsedit functional.
	 *
	 * @return void
	 */
	public function testRefundsedit()
	{
	    $this->get('refunds/1/edit')
	         ->seePageIs('refunds/');
	}

	/**
	 * A testRefundsupdate functional.
	 *
	 * @return void
	 */
	public function testRefundsupdate()
	{
	    $this->put('refunds/1')
	         ->seePageIs('refunds/');
	}

	/**
	 * A testRefundsrefunds functional.
	 *
	 * @return void
	 */
	public function testRefundsrefunds()
	{
	    $this->patch('refunds/1')
	         ->seePageIs('refunds/');
	}

	/**
	 * A testRefundsdestroy functional.
	 *
	 * @return void
	 */
	public function testRefundsdestroy()
	{
	    $this->delete('refunds/1')
	         ->seePageIs('refunds/');
	}
}
?>