<?php

use Ceb\Models\User;
use Ceb\Models\Loan;
use Ceb\Models\LoanRate;
use Ceb\Models\Posting;
use Ceb\Models\Setting;
use Ceb\Factories\LoanFactory;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoanFactoryTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCanInstatiateObject()
    {
    	$loanFactory = new LoanFactory(new Session, new User, new Loan,new LoanRate, new Posting,new Setting);
        
        $this->assertEquals(get_class($loanFactory),'Ceb\Factories\LoanFactory');
    }
}
