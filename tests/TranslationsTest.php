<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class translations extends TestCase{

	/**
	 * A testTranslationsviewgroup functional.
	 *
	 * @return void
	 */
	public function testTranslationsviewgroup()
	{
	    $this->get('translations/view/1')
	         ->seePageIs('translations/view/');
	}

	/**
	 * A testTranslationsindexonetwothreefourfive functional.
	 *
	 * @return void
	 */
	public function testTranslationsindexonetwothreefourfive()
	{
	    $this->get('translations/index/1/2/3/4/5')
	         ->seePageIs('translations/index/');
	}

	/**
	 * A testTranslations functional.
	 *
	 * @return void
	 */
	public function testTranslations()
	{
	    $this->get('translations')
	         ->seePageIs('translations');
	}

	/**
	 * A testTranslationsviewonetwothreefourfive functional.
	 *
	 * @return void
	 */
	public function testTranslationsviewonetwothreefourfive()
	{
	    $this->get('translations/view/1/2/3/4/5')
	         ->seePageIs('translations/view/');
	}

	/**
	 * A testTranslationsaddonetwothreefourfive functional.
	 *
	 * @return void
	 */
	public function testTranslationsaddonetwothreefourfive()
	{
	    $this->post('translations/add/1/2/3/4/5')
	         ->seePageIs('translations/add/');
	}

	/**
	 * A testTranslationseditonetwothreefourfive functional.
	 *
	 * @return void
	 */
	public function testTranslationseditonetwothreefourfive()
	{
	    $this->post('translations/edit/1/2/3/4/5')
	         ->seePageIs('translations/edit/');
	}

	/**
	 * A testTranslationsdeleteonetwothreefourfive functional.
	 *
	 * @return void
	 */
	public function testTranslationsdeleteonetwothreefourfive()
	{
	    $this->post('translations/delete/1/2/3/4/5')
	         ->seePageIs('translations/delete/');
	}

	/**
	 * A testTranslationsimportonetwothreefourfive functional.
	 *
	 * @return void
	 */
	public function testTranslationsimportonetwothreefourfive()
	{
	    $this->post('translations/import/1/2/3/4/5')
	         ->seePageIs('translations/import/');
	}

	/**
	 * A testTranslationsfindonetwothreefourfive functional.
	 *
	 * @return void
	 */
	public function testTranslationsfindonetwothreefourfive()
	{
	    $this->post('translations/find/1/2/3/4/5')
	         ->seePageIs('translations/find/');
	}

	/**
	 * A testTranslationspublishonetwothreefourfive functional.
	 *
	 * @return void
	 */
	public function testTranslationspublishonetwothreefourfive()
	{
	    $this->post('translations/publish/1/2/3/4/5')
	         ->seePageIs('translations/publish/');
	}

	/**
	 * A testTranslationsmissing functional.
	 *
	 * @return void
	 */
	public function testTranslationsmissing()
	{
	    $this->get('translations/1')
	         ->seePageIs('translations/');
	}
}
?>