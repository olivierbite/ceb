<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MonthlyRefundTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExcelReportExport()
    {
	    // $this->sentryUserBe('admin@admin.com');
        // $this->visit('reports/refunds/monthly/2/1')->assertResponseOk();;
    }

     /**
     * A basic test example.
     *
     * @return void
     */
    public function testWebViewReport()
    {
    	   $this->sentryUserBe('admin@admin.com');
        $this->visit('reports/refunds/monthly/2/0')->see('print');
    }
}
