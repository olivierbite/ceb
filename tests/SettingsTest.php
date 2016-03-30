<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class settings extends TestCase{

	/**
	 * A testSettingsinstitutionindex functional.
	 *
	 * @return void
	 */
	public function testSettingsinstitutionindex()
	{
	    $this->get('settings/institution')
	         ->seePageIs('settings/institution');
	}

	/**
	 * A testSettingsinstitutioncreate functional.
	 *
	 * @return void
	 */
	public function testSettingsinstitutioncreate()
	{
	    $this->get('settings/institution/create')
	         ->seePageIs('settings/institution/create');
	}

	/**
	 * A testSettingsinstitutionstore functional.
	 *
	 * @return void
	 */
	public function testSettingsinstitutionstore()
	{
	    $this->post('settings/institution')
	         ->seePageIs('settings/institution');
	}

	/**
	 * A testSettingsinstitutionshow functional.
	 *
	 * @return void
	 */
	public function testSettingsinstitutionshow()
	{
	    $this->get('settings/institution/1')
	         ->seePageIs('settings/institution/');
	}

	/**
	 * A testSettingsinstitutionedit functional.
	 *
	 * @return void
	 */
	public function testSettingsinstitutionedit()
	{
	    $this->get('settings/institution/1/edit')
	         ->seePageIs('settings/institution/');
	}

	/**
	 * A testSettingsinstitutionupdate functional.
	 *
	 * @return void
	 */
	public function testSettingsinstitutionupdate()
	{
	    $this->put('settings/institution/1')
	         ->seePageIs('settings/institution/');
	}

	/**
	 * A testSettingsinstitutioninstitution functional.
	 *
	 * @return void
	 */
	public function testSettingsinstitutioninstitution()
	{
	    $this->patch('settings/institution/1')
	         ->seePageIs('settings/institution/');
	}

	/**
	 * A testSettingsinstitutiondestroy functional.
	 *
	 * @return void
	 */
	public function testSettingsinstitutiondestroy()
	{
	    $this->delete('settings/institution/1')
	         ->seePageIs('settings/institution/');
	}

	/**
	 * A testSettingsaccountingplanindex functional.
	 *
	 * @return void
	 */
	public function testSettingsaccountingplanindex()
	{
	    $this->get('settings/accountingplan')
	         ->seePageIs('settings/accountingplan');
	}

	/**
	 * A testSettingsaccountingplancreate functional.
	 *
	 * @return void
	 */
	public function testSettingsaccountingplancreate()
	{
	    $this->get('settings/accountingplan/create')
	         ->seePageIs('settings/accountingplan/create');
	}

	/**
	 * A testSettingsaccountingplanstore functional.
	 *
	 * @return void
	 */
	public function testSettingsaccountingplanstore()
	{
	    $this->post('settings/accountingplan')
	         ->seePageIs('settings/accountingplan');
	}

	/**
	 * A testSettingsaccountingplanshow functional.
	 *
	 * @return void
	 */
	public function testSettingsaccountingplanshow()
	{
	    $this->get('settings/accountingplan/1')
	         ->seePageIs('settings/accountingplan/');
	}

	/**
	 * A testSettingsaccountingplanedit functional.
	 *
	 * @return void
	 */
	public function testSettingsaccountingplanedit()
	{
	    $this->get('settings/accountingplan/1/edit')
	         ->seePageIs('settings/accountingplan/');
	}

	/**
	 * A testSettingsaccountingplanupdate functional.
	 *
	 * @return void
	 */
	public function testSettingsaccountingplanupdate()
	{
	    $this->put('settings/accountingplan/1')
	         ->seePageIs('settings/accountingplan/');
	}

	/**
	 * A testSettingsaccountingplanaccountingplan functional.
	 *
	 * @return void
	 */
	public function testSettingsaccountingplanaccountingplan()
	{
	    $this->patch('settings/accountingplan/1')
	         ->seePageIs('settings/accountingplan/');
	}

	/**
	 * A testSettingsaccountingplandestroy functional.
	 *
	 * @return void
	 */
	public function testSettingsaccountingplandestroy()
	{
	    $this->delete('settings/accountingplan/1')
	         ->seePageIs('settings/accountingplan/');
	}

	/**
	 * A testCebsettingsusersindex functional.
	 *
	 * @return void
	 */
	public function testCebsettingsusersindex()
	{
	    $this->get('settings/users')
	         ->seePageIs('settings/users');
	}
}
?>