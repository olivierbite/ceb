<?php

namespace Ceb\Http\Controllers;

use Ceb\Http\Controllers\Controller;
use Ceb\Http\Requests;
use Ceb\Models\Institution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class InstitutionController extends Controller
{
    function __construct(Institution $institution) {
        $this->institution = $institution;
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         // First check if the user has the permission to do this
        if (!$this->user->hasAccess('institutions.view')) {
            flash()->error(trans('Sentinel::users.noaccess'));

            return redirect()->back();
        }

        // First log 
        Log::info($this->user->email . ' started to view institutions');
    
        $institutions = $this->institution->paginate(20);
        return view('settings.institution.list',compact('institutions'));
    }

   
}
