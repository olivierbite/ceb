<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class accounting extends TestCase{

	/**
	 * A testAccountingindex functional.
	 *
	 * @return void
	 */
	public function testAccountingindex()
	{
	    $this->get('accounting')
	         ->seePageIs('accounting');
	}

	/**
	 * A testAccountingcreate functional.
	 *
	 * @return void
	 */
	public function testAccountingcreate()
	{
	    $this->get('accounting/create')
	         ->seePageIs('accounting/create');
	}

	/**
	 * A testAccountingstore functional.
	 *
	 * @return void
	 */
	public function testAccountingstore()
	{
	    $this->post('accounting')
	         ->seePageIs('accounting');
	}

	/**
	 * A testAccountingshow functional.
	 *
	 * @return void
	 */
	public function testAccountingshow()
	{
	    $this->get('accounting/1')
	         ->seePageIs('accounting/');
	}

	/**
	 * A testAccountingedit functional.
	 *
	 * @return void
	 */
	public function testAccountingedit()
	{
	    $this->get('accounting/1/edit')
	         ->seePageIs('accounting/');
	}

	/**
	 * A testAccountingupdate functional.
	 *
	 * @return void
	 */
	public function testAccountingupdate()
	{
	    $this->put('accounting/1')
	         ->seePageIs('accounting/');
	}

	/**
	 * A testAccountingaccounting functional.
	 *
	 * @return void
	 */
	public function testAccountingaccounting()
	{
	    $this->patch('accounting/1')
	         ->seePageIs('accounting/');
	}

	/**
	 * A testAccountingdestroy functional.
	 *
	 * @return void
	 */
	public function testAccountingdestroy()
	{
	    $this->delete('accounting/1')
	         ->seePageIs('accounting/');
	}
}
?>