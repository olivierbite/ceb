<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class sessions extends TestCase{

	/**
	 * A testSentinelsessioncreate functional.
	 *
	 * @return void
	 */
	public function testSentinelsessioncreate()
	{
	    $this->get('sessions/create')
	         ->seePageIs('sessions/create');
	}

	/**
	 * A testSentinelsessionstore functional.
	 *
	 * @return void
	 */
	public function testSentinelsessionstore()
	{
	    $this->post('sessions/store')
	         ->seePageIs('sessions/store');
	}

	/**
	 * A testSentinelsessiondestroy functional.
	 *
	 * @return void
	 */
	public function testSentinelsessiondestroy()
	{
	    $this->delete('sessions/destroy')
	         ->seePageIs('sessions/destroy');
	}
}
?>