<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class contributions extends TestCase{

	/**
	 * A testContributionscomplete functional.
	 *
	 * @return void
	 */
	public function testContributionscomplete()
	{
	    $this->post('contributions/complete')
	         ->seePageIs('contributions/complete');
	}

	/**
	 * A testContributionscancel functional.
	 *
	 * @return void
	 */
	public function testContributionscancel()
	{
	    $this->get('contributions/cancel')
	         ->seePageIs('contributions/cancel');
	}

	/**
	 * A testContributionsbatch functional.
	 *
	 * @return void
	 */
	public function testContributionsbatch()
	{
	    $this->post('contributions/batch')
	         ->seePageIs('contributions/batch');
	}

	/**
	 * A testContributionsremovemember functional.
	 *
	 * @return void
	 */
	public function testContributionsremovemember()
	{
	    $this->get('contributions/1/remove')
	         ->seePageIs('contributions/');
	}

	/**
	 * A testContributionssamplecsv functional.
	 *
	 * @return void
	 */
	public function testContributionssamplecsv()
	{
	    $this->get('contributions/samplecsv')
	         ->seePageIs('contributions/samplecsv');
	}

	/**
	 * A testContributionsindex functional.
	 *
	 * @return void
	 */
	public function testContributionsindex()
	{
	    $this->get('contributions')
	         ->seePageIs('contributions');
	}

	/**
	 * A testContributionscreate functional.
	 *
	 * @return void
	 */
	public function testContributionscreate()
	{
	    $this->get('contributions/create')
	         ->seePageIs('contributions/create');
	}

	/**
	 * A testContributionsstore functional.
	 *
	 * @return void
	 */
	public function testContributionsstore()
	{
	    $this->post('contributions')
	         ->seePageIs('contributions');
	}

	/**
	 * A testContributionsshow functional.
	 *
	 * @return void
	 */
	public function testContributionsshow()
	{
	    $this->get('contributions/1')
	         ->seePageIs('contributions/');
	}

	/**
	 * A testContributionsedit functional.
	 *
	 * @return void
	 */
	public function testContributionsedit()
	{
	    $this->get('contributions/1/edit')
	         ->seePageIs('contributions/');
	}

	/**
	 * A testContributionsupdate functional.
	 *
	 * @return void
	 */
	public function testContributionsupdate()
	{
	    $this->put('contributions/1')
	         ->seePageIs('contributions/');
	}

	/**
	 * A testContributionscontributions functional.
	 *
	 * @return void
	 */
	public function testContributionscontributions()
	{
	    $this->patch('contributions/1')
	         ->seePageIs('contributions/');
	}

	/**
	 * A testContributionsdestroy functional.
	 *
	 * @return void
	 */
	public function testContributionsdestroy()
	{
	    $this->delete('contributions/1')
	         ->seePageIs('contributions/');
	}
}
?>