<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class users extends TestCase{

	/**
	 * A testSentinelactivate functional.
	 *
	 * @return void
	 */
	public function testSentinelactivate()
	{
	    $this->get('users/activate/1/2')
	         ->seePageIs('users/activate/');
	}

	/**
	 * A testSentinelusersindex functional.
	 *
	 * @return void
	 */
	public function testSentinelusersindex()
	{
	    $this->get('users')
	         ->seePageIs('users');
	}

	/**
	 * A testSentineluserscreate functional.
	 *
	 * @return void
	 */
	public function testSentineluserscreate()
	{
	    $this->get('users/create')
	         ->seePageIs('users/create');
	}

	/**
	 * A testSentinelusersstore functional.
	 *
	 * @return void
	 */
	public function testSentinelusersstore()
	{
	    $this->post('users')
	         ->seePageIs('users');
	}

	/**
	 * A testSentinelusersshow functional.
	 *
	 * @return void
	 */
	public function testSentinelusersshow()
	{
	    $this->get('users/1')
	         ->seePageIs('users/');
	}

	/**
	 * A testSentinelusersedit functional.
	 *
	 * @return void
	 */
	public function testSentinelusersedit()
	{
	    $this->get('users/1/edit')
	         ->seePageIs('users/');
	}

	/**
	 * A testSentinelpasswordchange functional.
	 *
	 * @return void
	 */
	public function testSentinelpasswordchange()
	{
	    $this->post('users/1/password')
	         ->seePageIs('users/');
	}

	/**
	 * A testSentinelusersmemberships functional.
	 *
	 * @return void
	 */
	public function testSentinelusersmemberships()
	{
	    $this->post('users/1/memberships')
	         ->seePageIs('users/');
	}

	/**
	 * A testSentinelusersupdate functional.
	 *
	 * @return void
	 */
	public function testSentinelusersupdate()
	{
	    $this->put('users/1')
	         ->seePageIs('users/');
	}

	/**
	 * A testSentinelusersdestroy functional.
	 *
	 * @return void
	 */
	public function testSentinelusersdestroy()
	{
	    $this->delete('users/1')
	         ->seePageIs('users/');
	}

	/**
	 * A testSentineluserssuspend functional.
	 *
	 * @return void
	 */
	public function testSentineluserssuspend()
	{
	    $this->get('users/1/suspend')
	         ->seePageIs('users/');
	}

	/**
	 * A testSentinelusersunsuspend functional.
	 *
	 * @return void
	 */
	public function testSentinelusersunsuspend()
	{
	    $this->get('users/1/unsuspend')
	         ->seePageIs('users/');
	}

	/**
	 * A testSentinelusersban functional.
	 *
	 * @return void
	 */
	public function testSentinelusersban()
	{
	    $this->get('users/1/ban')
	         ->seePageIs('users/');
	}

	/**
	 * A testSentinelusersunban functional.
	 *
	 * @return void
	 */
	public function testSentinelusersunban()
	{
	    $this->get('users/1/unban')
	         ->seePageIs('users/');
	}
}
?>