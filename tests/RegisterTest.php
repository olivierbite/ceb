<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class register extends TestCase{

	/**
	 * A testSentinelregisterform functional.
	 *
	 * @return void
	 */
	public function testSentinelregisterform()
	{
	    $this->get('register')
	         ->seePageIs('register');
	}

	/**
	 * A testSentinelregisteruser functional.
	 *
	 * @return void
	 */
	public function testSentinelregisteruser()
	{
	    $this->post('register')
	         ->seePageIs('register');
	}
}
?>