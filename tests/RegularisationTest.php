<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class regularisation extends TestCase{

	/**
	 * A testRegularisationindex functional.
	 *
	 * @return void
	 */
	public function testRegularisationindex()
	{
	    $this->get('regularisation')
	         ->seePageIs('regularisation');
	}

	/**
	 * A testRegularisationsetmember functional.
	 *
	 * @return void
	 */
	public function testRegularisationsetmember()
	{
	    $this->get('regularisation/1')
	         ->seePageIs('regularisation/');
	}

	/**
	 * A testRegularisationaddcautionneur functional.
	 *
	 * @return void
	 */
	public function testRegularisationaddcautionneur()
	{
	    $this->get('regularisation/setcautionneur')
	         ->seePageIs('regularisation/setcautionneur');
	}

	/**
	 * A testRegularisationcancel functional.
	 *
	 * @return void
	 */
	public function testRegularisationcancel()
	{
	    $this->get('regularisation/cancel')
	         ->seePageIs('regularisation/cancel');
	}

	/**
	 * A testRegularisationcomplete functional.
	 *
	 * @return void
	 */
	public function testRegularisationcomplete()
	{
	    $this->post('regularisation/complete')
	         ->seePageIs('regularisation/complete');
	}

	/**
	 * A testRegularisationremovecautionneur functional.
	 *
	 * @return void
	 */
	public function testRegularisationremovecautionneur()
	{
	    $this->get('regularisation/remove/cautionneur/1')
	         ->seePageIs('regularisation/remove/cautionneur/');
	}
}
?>