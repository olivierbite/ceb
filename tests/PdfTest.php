<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class pdf extends TestCase{

	/**
	 * A testPdf functional.
	 *
	 * @return void
	 */
	public function testPdf()
	{
	    $this->get('pdf')
	         ->seePageIs('pdf');
	}
}
?>