<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class default extends TestCase{

	/**
	 * A testHome functional.
	 *
	 * @return void
	 */
	public function testHome()
	{
	    $this->get('/')
	         ->seePageIs('/');
	}
}
?>