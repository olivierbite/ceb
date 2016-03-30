<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class reactivate extends TestCase{

	/**
	 * A testSentinelreactivateform functional.
	 *
	 * @return void
	 */
	public function testSentinelreactivateform()
	{
	    $this->get('reactivate')
	         ->seePageIs('reactivate');
	}

	/**
	 * A testSentinelreactivatesend functional.
	 *
	 * @return void
	 */
	public function testSentinelreactivatesend()
	{
	    $this->post('reactivate')
	         ->seePageIs('reactivate');
	}
}
?>