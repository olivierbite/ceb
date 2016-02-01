<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MembersTest extends TestCase
{

    /**
     * A test welcome page for member module.
     *
     * @return void
     */
    public function testMemberList()
    {
    	$this->sentryUserBe();
        $this->visit('/members')
             ->seePageIs('/members')
             ->see('members')
             ->see('institution')
             ->see('district')
             ->see('service')
             ->see('names');
    }

    /** Test click add new member */
    public function testClickNewMember()
	{
		$this->sentryUserBe();
	    $this->visit('/members')
	         ->click('Add')
	         ->seePageIs('/members/create');
	}

	public function testNewMemberRegistration()
	{
		$absolutePathToFile = public_path('/assets/images/header.png');

		$this->sentryUserBe();
	    $this->visit('/members/create')
	         ->type('TestDistrict', 'district')
		     ->type('TestProvince', 'province')
		     ->select('1','institution_id')
	         ->type('TestService', 'service')
	         ->type('10000', 'monthly_fee')
	         ->type('FirtName LastName', 'names')
	         ->type('1970-01-01', 'date_of_birth')
	         ->select('Female','sex')
	         ->type('1198980002254699', 'member_nid')
	         ->type('Rwandan', 'nationality')
	         ->type('ceb@email.com', 'email')
	         ->type('0722222222', 'telephone')

	         /** ADD ATTACHMENTS */
	         ->attach($absolutePathToFile, 'photo')
	         ->attach($absolutePathToFile, 'signature')
	         /** END OF ATTACHMENTS */

	         ->press('Add New')
	         ->seePageIs('/members/create');
	}
}
