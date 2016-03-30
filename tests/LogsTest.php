<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class logs extends TestCase{

	/**
	 * A testLogs functional.
	 *
	 * @return void
	 */
	public function testLogs()
	{
	    $this->get('logs')
	         ->seePageIs('logs');
	}
}
?>