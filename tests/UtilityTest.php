<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class utility extends TestCase{

	/**
	 * A testUtilitybackup functional.
	 *
	 * @return void
	 */
	public function testUtilitybackup()
	{
	    $this->get('utility/backup')
	         ->seePageIs('utility/backup');
	}
}
?>