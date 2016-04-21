<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MemberRepositoryTest extends TestCase
{
    /**
     * A generateAdhersionID test.
     *
     * @return void
     */
    public function testGenerateAdhersionId()
    {
    	$user = new \Ceb\Models\User;
    	$expected = \Ceb\Models\User::where('email','<>','admin@admin.com')->max('adhersion_id') + 1;
        $this->assertEquals($expected,$user->generateAdhersionID());
    }
}
