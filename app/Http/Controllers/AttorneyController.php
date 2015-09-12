<?php

namespace Ceb\Http\Controllers;

use Illuminate\Http\Request;
use Ceb\Repositories\Attorney\AttorneyRepository;
use Ceb\Http\Requests;
use Ceb\Http\Controllers\Controller;
use Ceb\Http\Requests\AttorneyRequest;
use Redirect;
class AttorneyController  extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $member = $request->get('member');
        return view('attornies.create',compact('member'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(AttorneyRequest $request,AttorneyRepository $attornies)
    {
       $message = $attornies->store($request->all());
       flash()->success($message);
       return Redirect::route('members.show',['members'=>$request->get('member')]);
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
