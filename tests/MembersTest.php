<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class members extends TestCase{

	/**
	 * A testMemberssearch functional.
	 *
	 * @return void
	 */
	public function testMemberssearch()
	{
	    $this->get('members/search')
	         ->seePageIs('members/search');
	}

	/**
	 * A testMembersrefund functional.
	 *
	 * @return void
	 */
	public function testMembersrefund()
	{
	    $this->get('members/1/refund')
	         ->seePageIs('members/');
	}

	/**
	 * A testMemberscontribute functional.
	 *
	 * @return void
	 */
	public function testMemberscontribute()
	{
	    $this->get('members/1/contribute')
	         ->seePageIs('members/');
	}

	/**
	 * A testMemberstransacts functional.
	 *
	 * @return void
	 */
	public function testMemberstransacts()
	{
	    $this->get('members/1/transacts')
	         ->seePageIs('members/');
	}

	/**
	 * A testMemberscompletetransaction functional.
	 *
	 * @return void
	 */
	public function testMemberscompletetransaction()
	{
	    $this->post('members/1/completetransaction')
	         ->seePageIs('members/');
	}

	/**
	 * A testMembersattornies functional.
	 *
	 * @return void
	 */
	public function testMembersattornies()
	{
	    $this->get('members/1/attornies')
	         ->seePageIs('members/');
	}

	/**
	 * A testMembersloanrecords functional.
	 *
	 * @return void
	 */
	public function testMembersloanrecords()
	{
	    $this->get('members/loanrecords/1')
	         ->seePageIs('members/loanrecords/');
	}

	/**
	 * A testMemberscontributions functional.
	 *
	 * @return void
	 */
	public function testMemberscontributions()
	{
	    $this->get('members/contributions/1')
	         ->seePageIs('members/contributions/');
	}

	/**
	 * A testMemberscautionsactives functional.
	 *
	 * @return void
	 */
	public function testMemberscautionsactives()
	{
	    $this->get('members/cautions/1')
	         ->seePageIs('members/cautions/');
	}

	/**
	 * A testMemberscautionedactives functional.
	 *
	 * @return void
	 */
	public function testMemberscautionedactives()
	{
	    $this->get('members/cautioned/1')
	         ->seePageIs('members/cautioned/');
	}

	/**
	 * A testMembersindex functional.
	 *
	 * @return void
	 */
	public function testMembersindex()
	{
	    $this->get('members')
	         ->seePageIs('members');
	}

	/**
	 * A testMemberscreate functional.
	 *
	 * @return void
	 */
	public function testMemberscreate()
	{
	    $this->get('members/create')
	         ->seePageIs('members/create');
	}

	/**
	 * A testMembersstore functional.
	 *
	 * @return void
	 */
	public function testMembersstore()
	{
	    $this->post('members')
	         ->seePageIs('members');
	}

	/**
	 * A testMembersshow functional.
	 *
	 * @return void
	 */
	public function testMembersshow()
	{
	    $this->get('members/1')
	         ->seePageIs('members/');
	}

	/**
	 * A testMembersedit functional.
	 *
	 * @return void
	 */
	public function testMembersedit()
	{
	    $this->get('members/1/edit')
	         ->seePageIs('members/');
	}

	/**
	 * A testMembersupdate functional.
	 *
	 * @return void
	 */
	public function testMembersupdate()
	{
	    $this->put('members/1')
	         ->seePageIs('members/');
	}

	/**
	 * A testMembersmembers functional.
	 *
	 * @return void
	 */
	public function testMembersmembers()
	{
	    $this->patch('members/1')
	         ->seePageIs('members/');
	}

	/**
	 * A testMembersdestroy functional.
	 *
	 * @return void
	 */
	public function testMembersdestroy()
	{
	    $this->delete('members/1')
	         ->seePageIs('members/');
	}
}
?>