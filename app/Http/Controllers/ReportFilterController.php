<?php

namespace Ceb\Http\Controllers;

use Ceb\Http\Controllers\Controller;
use Ceb\Http\Requests;
use Illuminate\Http\Request;

class ReportFilterController extends Controller
{
    public $filterOptions = [
        'member_search'     => false,
        'show_institution'  => false,
        'show_dates'        => false,
        'show_exports'     => false,
    ];

    function __construct() {
        $this->filterOptions = (object) $this->filterOptions;
        parent::__construct();
    }

    /**
     * Show date filter 
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {  
         
         // If we have a show instition parameters, then make sure it is set here
         if ($request->has('show_institution')) {
             $this->filterOptions->show_institution = (bool) $request->get('show_institution');
         }

         // Do we need to show the search input for members?
         if ($request->has('member_search')) {
             $this->filterOptions->member_search    = (bool) $request->get('member_search');
         }

         // Do we need to show the dates
         if ($request->has('show_dates')) {
             $this->filterOptions->show_dates       = (bool) $request->get('show_dates');
         }

         // Should we show export options
         if ($request->has('show_exports')) {
            $this->filterOptions->show_exports      = (bool) $request->get('show_exports');
         }

         $filterOptions = $this->filterOptions;
         $reportUrl = $request->get('reporturl');
         $title     = trans('report.'.str_replace('/','.',$reportUrl));
         return view('reports.filters.date_filter',compact('reportUrl','title','filterOptions'));
    }
}
