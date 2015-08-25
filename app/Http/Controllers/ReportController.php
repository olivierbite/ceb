<?php

namespace Ceb\Http\Controllers;

use Illuminate\Http\Request;

use Ceb\Http\Requests;
use Ceb\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function index()
    {
    	return view('reports.index');
    }
}
