<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testDashboardPage()
    {
        $this->sentryUserBe();
        $this->visit('/')
             ->see('dashboard');
    }

    public function testBasicExample()
    {
        $this->sentryUserBe();
        $this->visit('/members')
             ->seePageIs('/members')
             ->see('members');
    }
}
