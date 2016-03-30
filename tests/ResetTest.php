<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class reset extends TestCase{

	/**
	 * A testSentinelresetform functional.
	 *
	 * @return void
	 */
	public function testSentinelresetform()
	{
	    $this->get('reset/1/2')
	         ->seePageIs('reset/');
	}

	/**
	 * A testSentinelresetpassword functional.
	 *
	 * @return void
	 */
	public function testSentinelresetpassword()
	{
	    $this->post('reset/1/2')
	         ->seePageIs('reset/');
	}
}
?>