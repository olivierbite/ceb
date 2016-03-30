<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class files extends TestCase{

	/**
	 * A testFiles functional.
	 *
	 * @return void
	 */
	public function testFiles()
	{
	    $this->get('files')
	         ->seePageIs('files');
	}

	/**
	 * A testFilesget functional.
	 *
	 * @return void
	 */
	public function testFilesget()
	{
	    $this->get('files/get/1')
	         ->seePageIs('files/get/');
	}

	/**
	 * A testFilesadd functional.
	 *
	 * @return void
	 */
	public function testFilesadd()
	{
	    $this->post('files/add')
	         ->seePageIs('files/add');
	}
}
?>