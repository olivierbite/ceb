<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class leaves extends TestCase{

	/**
	 * A testLeavesrequest functional.
	 *
	 * @return void
	 */
	public function testLeavesrequest()
	{
	    $this->get('leaves/request')
	         ->seePageIs('leaves/request');
	}

	/**
	 * A testLeavesshow functional.
	 *
	 * @return void
	 */
	public function testLeavesshow()
	{
	    $this->get('leaves/show')
	         ->seePageIs('leaves/show');
	}

	/**
	 * A testLeavespending functional.
	 *
	 * @return void
	 */
	public function testLeavespending()
	{
	    $this->get('leaves/pending')
	         ->seePageIs('leaves/pending');
	}

	/**
	 * A testLeavesapprove functional.
	 *
	 * @return void
	 */
	public function testLeavesapprove()
	{
	    $this->get('leaves/approve/1')
	         ->seePageIs('leaves/approve/');
	}

	/**
	 * A testLeavesreject functional.
	 *
	 * @return void
	 */
	public function testLeavesreject()
	{
	    $this->get('leaves/reject/1')
	         ->seePageIs('leaves/reject/');
	}

	/**
	 * A testLeavesstatus functional.
	 *
	 * @return void
	 */
	public function testLeavesstatus()
	{
	    $this->get('leaves/status/1')
	         ->seePageIs('leaves/status/');
	}

	/**
	 * A testLeavesindex functional.
	 *
	 * @return void
	 */
	public function testLeavesindex()
	{
	    $this->get('leaves')
	         ->seePageIs('leaves');
	}

	/**
	 * A testLeavescreate functional.
	 *
	 * @return void
	 */
	public function testLeavescreate()
	{
	    $this->get('leaves/create')
	         ->seePageIs('leaves/create');
	}

	/**
	 * A testLeavesstore functional.
	 *
	 * @return void
	 */
	public function testLeavesstore()
	{
	    $this->post('leaves')
	         ->seePageIs('leaves');
	}
}
?>