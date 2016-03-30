<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class login extends TestCase{

	/**
	 * A testSentinellogin functional.
	 *
	 * @return void
	 */
	public function testSentinellogin()
	{
	    $this->get('login')
	         ->seePageIs('login');
	}
}
?>