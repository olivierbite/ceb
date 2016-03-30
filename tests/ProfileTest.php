<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class profile extends TestCase{

	/**
	 * A testSentinelprofileshow functional.
	 *
	 * @return void
	 */
	public function testSentinelprofileshow()
	{
	    $this->get('profile')
	         ->seePageIs('profile');
	}

	/**
	 * A testSentinelprofileedit functional.
	 *
	 * @return void
	 */
	public function testSentinelprofileedit()
	{
	    $this->get('profile/edit')
	         ->seePageIs('profile/edit');
	}

	/**
	 * A testSentinelprofileupdate functional.
	 *
	 * @return void
	 */
	public function testSentinelprofileupdate()
	{
	    $this->put('profile')
	         ->seePageIs('profile');
	}

	/**
	 * A testSentinelprofilepassword functional.
	 *
	 * @return void
	 */
	public function testSentinelprofilepassword()
	{
	    $this->post('profile/password')
	         ->seePageIs('profile/password');
	}
}
?>