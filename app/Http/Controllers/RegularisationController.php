<?php

namespace Ceb\Http\Controllers;

use Illuminate\Http\Request;
use Ceb\Models\Loan;
use Ceb\Models\User;
use Ceb\Http\Requests;
use Ceb\Http\Controllers\Controller;

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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
