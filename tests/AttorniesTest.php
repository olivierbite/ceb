<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class attornies extends TestCase{

	/**
	 * A testAttorniesindex functional.
	 *
	 * @return void
	 */
	public function testAttorniesindex()
	{
	    $this->get('attornies')
	         ->seePageIs('attornies');
	}

	/**
	 * A testAttorniescreate functional.
	 *
	 * @return void
	 */
	public function testAttorniescreate()
	{
	    $this->get('attornies/create')
	         ->seePageIs('attornies/create');
	}

	/**
	 * A testAttorniesstore functional.
	 *
	 * @return void
	 */
	public function testAttorniesstore()
	{
	    $this->post('attornies')
	         ->seePageIs('attornies');
	}

	/**
	 * A testAttorniesshow functional.
	 *
	 * @return void
	 */
	public function testAttorniesshow()
	{
	    $this->get('attornies/1')
	         ->seePageIs('attornies/');
	}

	/**
	 * A testAttorniesedit functional.
	 *
	 * @return void
	 */
	public function testAttorniesedit()
	{
	    $this->get('attornies/1/edit')
	         ->seePageIs('attornies/');
	}

	/**
	 * A testAttorniesupdate functional.
	 *
	 * @return void
	 */
	public function testAttorniesupdate()
	{
	    $this->put('attornies/1')
	         ->seePageIs('attornies/');
	}

	/**
	 * A testAttorniesattornies functional.
	 *
	 * @return void
	 */
	public function testAttorniesattornies()
	{
	    $this->patch('attornies/1')
	         ->seePageIs('attornies/');
	}

	/**
	 * A testAttorniesdestroy functional.
	 *
	 * @return void
	 */
	public function testAttorniesdestroy()
	{
	    $this->delete('attornies/1')
	         ->seePageIs('attornies/');
	}
}
?>