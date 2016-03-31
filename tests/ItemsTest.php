<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class items extends TestCase{

	/**
	 * A testItemsindex functional.
	 *
	 * @return void
	 */
	public function testItemsindex()
	{
	    $this->get('items')
	         ->seePageIs('items');
	}

	/**
	 * A testItemsadd functional.
	 *
	 * @return void
	 */
	public function testItemsadd()
	{
	    $this->get('items/add')
	         ->seePageIs('items/add');
	}

	/**
	 * A testItemsedit functional.
	 *
	 * @return void
	 */
	public function testItemsedit()
	{
	    $this->get('items/edit/1')
	         ->seePageIs('items/edit/');
	}

	/**
	 * A testItemsdelete functional.
	 *
	 * @return void
	 */
	public function testItemsdelete()
	{
	    $this->get('items/delete/1')
	         ->seePageIs('items/delete/');
	}
}
?>