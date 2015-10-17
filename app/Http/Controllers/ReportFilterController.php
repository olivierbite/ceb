<?php

namespace Ceb\Http\Controllers;

use Ceb\Http\Controllers\Controller;
use Ceb\Http\Requests;
use Illuminate\Http\Request;

class ReportFilterController extends Controller
{

    function __construct() {
        parent::__construct();
    }

    /**
     * Show date filter 
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function dateFilter(Request $request)
    {
         $reportUrl = $request->get('reporturl');
         $title     = trans('report.filterByDate');
         return view('reports.filters.date_filter',compact('reportUrl','title'));
    }

    /**
     * Show member filter
     *                         
     * @param  string $reportname
     * @return   view
     */
    public function memberFilter(Request $request)
    {
         $reportUrl = $request->get('reporturl');
         $title     = trans('general.type_below_to_seach_for_a_member');
         return view('reports.filters.member_filter',compact('reportUrl','title'));
    }
}
