<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class groups extends TestCase{

	/**
	 * A testSentinelgroupsindex functional.
	 *
	 * @return void
	 */
	public function testSentinelgroupsindex()
	{
	    $this->get('groups')
	         ->seePageIs('groups');
	}

	/**
	 * A testSentinelgroupscreate functional.
	 *
	 * @return void
	 */
	public function testSentinelgroupscreate()
	{
	    $this->get('groups/create')
	         ->seePageIs('groups/create');
	}

	/**
	 * A testSentinelgroupsstore functional.
	 *
	 * @return void
	 */
	public function testSentinelgroupsstore()
	{
	    $this->post('groups')
	         ->seePageIs('groups');
	}

	/**
	 * A testSentinelgroupsshow functional.
	 *
	 * @return void
	 */
	public function testSentinelgroupsshow()
	{
	    $this->get('groups/1')
	         ->seePageIs('groups/');
	}

	/**
	 * A testSentinelgroupsedit functional.
	 *
	 * @return void
	 */
	public function testSentinelgroupsedit()
	{
	    $this->get('groups/1/edit')
	         ->seePageIs('groups/');
	}

	/**
	 * A testSentinelgroupsupdate functional.
	 *
	 * @return void
	 */
	public function testSentinelgroupsupdate()
	{
	    $this->put('groups/1')
	         ->seePageIs('groups/');
	}

	/**
	 * A testSentinelgroupsdestroy functional.
	 *
	 * @return void
	 */
	public function testSentinelgroupsdestroy()
	{
	    $this->delete('groups/1')
	         ->seePageIs('groups/');
	}
}
?>