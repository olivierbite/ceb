<?php

namespace Ceb\Http\Controllers;

use Ceb\Http\Controllers\Controller;
use Ceb\Http\Requests;
use Ceb\Models\Loan;
use Ceb\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RegularisationController extends Controller
{
    function __construct(Loan $loan, User $member) {
        $this->loan = $loan;
        $this->member = $member;
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->show(null);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id = null)
    {
          // First check if the user has the permission to do this
        if (!$this->user->hasAccess('regularisation.view')) {
            flash()->error(trans('Sentinel::users.noaccess'));

            return redirect()->back();
        }

        // First log 
        Log::info($this->user->email . ' is viewing regularisation');
    
        $member =  $this->member;
        $loan  = $member->latestLoan(); 

        // If passed id is not null try to get the member
       if (!is_null($id)) {  
        $member =  $this->member->findOrFail($id);
        $loan  = $member->latestLoan();
        if ($loan == null) {
            flash()->warning(trans('regularisation.this_member_doesnot_have_loan_to_regulate'));
        }
       }
       return view('regularisation.index',compact('loan','member'));
    }

    
}
