<?php

namespace Ceb\Http\Controllers;

use Illuminate\Http\Request;
use Ceb\Http\Requests;
use Ceb\Http\Controllers\Controller;

class HomeController extends Controller
{
    function __construct() {
    	
    	parent::__construct();
    }

    public function index()
    {
    	return view('partials.dashboard');
    }
}
