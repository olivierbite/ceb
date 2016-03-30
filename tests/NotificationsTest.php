<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class notifications extends TestCase{

	/**
	 * A testNotificatons functional.
	 *
	 * @return void
	 */
	public function testNotificatons()
	{
	    $this->get('notifications')
	         ->seePageIs('notifications');
	}
}
?>