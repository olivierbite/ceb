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
       $loans = $this->loan->paginate(20);

       return view('regularisation.index',compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
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
