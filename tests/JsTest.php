<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class js extends TestCase{

	/**
	 * A testAssetsjsloanform functional.
	 *
	 * @return void
	 */
	public function testAssetsjsloanform()
	{
	    $this->get('js/loanform')
	         ->seePageIs('js/loanform');
	}

	/**
	 * A testAssetsjsregularisationform functional.
	 *
	 * @return void
	 */
	public function testAssetsjsregularisationform()
	{
	    $this->get('js/regularisationform')
	         ->seePageIs('js/regularisationform');
	}
}
?>