<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class ajax extends TestCase{

	/**
	 * A testAjaxloans functional.
	 *
	 * @return void
	 */
	public function testAjaxloans()
	{
	    $this->get('ajax/loans')
	         ->seePageIs('ajax/loans');
	}

	/**
	 * A testAjaxaccounting functional.
	 *
	 * @return void
	 */
	public function testAjaxaccounting()
	{
	    $this->post('ajax/regularisation/accounting')
	         ->seePageIs('ajax/regularisation/accounting');
	}

	/**
	 * A testAjaxregularisation functional.
	 *
	 * @return void
	 */
	public function testAjaxregularisation()
	{
	    $this->get('ajax/regularisation')
	         ->seePageIs('ajax/regularisation');
	}
}
?>