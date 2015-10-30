<?php

namespace Ceb\Http\Controllers;

use Ceb\Http\Controllers\Controller;
use Ceb\Http\Requests;
use Ceb\Models\Leave;
use Ceb\Models\User;
use Fenos\Notifynder\Notifynder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeaveController extends Controller
{
    function __construct() {
        parent::__construct();
    }


    /**
     * Display a listing of the resource.
     * GET /leavemanagement
     *
     * @return Response
     */
    public function index()
    {
            $leaves = Leave::paginate(20);
            return view('leaves.pending', array('leaves' => $leaves));
    }
    /**
     * Show the form for creating a new resource.
     * GET /leavemanagement/approve/{leave}
     *
     * @return Response
     */
    public function approve($id,Notifynder $notifier)
    {
            $leave = Leave::findOrFail($id);
            $leave->status = Leave::$approved;
            $leave->save();
                    // Send notification
        $notifier->category('leave.approved')
                   ->from($this->user->id)
                   ->to($leave->user_id)
                   ->url(route('leaves.show'))
                   ->send();

            flash()->success(trans('leave.leave_approved_successfully'));
            return redirect()->route('leaves.pending'); 
    }
    /**
     * Display the specified resource.
     * GET /leavemanagement/reject/{leave}
     *
     * @param  int  $leave
     * @return Response
     */
    public function reject($id,Notifynder $notifier)
    {
            $leave = Leave::findOrFail($id);
            $leave->status = Leave::$rejected;
            $leave->save();
            
               // Send notification
        $notifier->category('leave.rejected')
                   ->from($this->user->id)
                   ->to($leave->user_id)
                   ->url(route('leaves.show'))
                   ->send();

            flash()->success(trans('leave.leave_rejected_successfully'));
            
            return redirect()->route('leaves.pending'); 
    }
    /**
     * Display a listing of the logged in user leaves.
     * 
     * GET /leave/show
     *
     * @return Response
     */
    public function show(User $employee)
    {
        $userId = $this->user->id;
        $userLeaves = $employee->whereHas('leaves', function($q) use($userId) {
                        $q->where('user_id', '=',$userId);
                    })->get();
        $leaves = count($userLeaves) ? $userLeaves[0]->leaves : null;

        return view('leaves.show', array('leaves' => $leaves));
    }
    /**
     * Show the form for creating a new resource.
     * GET /leave/create
     *
     * @return Response
     */
    public function create()
    {
        $title = trans('leave.new_leave');
        return view('leaves.create',compact('title'));
    }
    /**
     * Store a newly created resource in storage.
     * POST /leave
     *
     * @return Response
     */
    public function store(Request $request,Notifynder $notifier)
    {
        $data =  $request->only(['start', 'end']);
        $data['start'] = $request->get('start_year').'-'.$request->get('start_month').'-'.$request->get('start_day') ;    
        $data['end'] =   $request->get('end_year') .'-'.$request->get('end_month').'-'.$request->get('end_day');    

        $validator = Validator::make(
                        $data, [
                            'start' => 'required|date_format:"Y-m-d"',
                            'end' => 'required||date_format:"Y-m-d"',
                        ]
        );
        if ($validator->fails()) {
            return redirect()->route('leaves.create')->withErrors($validator)->withInput();
        }
      

        $data['user_id'] = $this->user->id;
        $data['status'] = Leave::$applied;
        $data['start'] = date("Y-m-d", strtotime($data['start']));
        $data['end'] = date("Y-m-d", strtotime($data['end']));

        $newLeave = Leave::create($data);
        if ($newLeave) {

        // Send notification
        $notifier->category('leave.leave')
                   ->from($this->user->id)
                   ->to(1)
                   ->url(route('leaves.index'))
                   ->send();

            return redirect()->route('leaves.index');
        }
        return redirect()->route('leaves.create')->withInput();
    }
    /**
     * Display the specified resource.
     * GET /leave/{leave}
     *
     * @param  int  $leave
     * @return Response
     */
    public function status($id)
    {   
        $leave = Leave::findOrFail($id);

        return view('leaves.status', array('leave' => $leave));
    }
}
