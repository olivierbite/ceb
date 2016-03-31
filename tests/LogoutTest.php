<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class logout extends TestCase{

	/**
	 * A testSentinellogout functional.
	 *
	 * @return void
	 */
	public function testSentinellogout()
	{
	    $this->get('logout')
	         ->seePageIs('logout');
	}
}
?>