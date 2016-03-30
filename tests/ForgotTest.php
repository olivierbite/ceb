<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class forgot extends TestCase{

	/**
	 * A testSentinelforgotform functional.
	 *
	 * @return void
	 */
	public function testSentinelforgotform()
	{
	    $this->get('forgot')
	         ->seePageIs('forgot');
	}

	/**
	 * A testSentinelresetrequest functional.
	 *
	 * @return void
	 */
	public function testSentinelresetrequest()
	{
	    $this->post('forgot')
	         ->seePageIs('forgot');
	}
}
?>