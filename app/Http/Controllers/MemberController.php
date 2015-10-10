<?php

namespace Ceb\Http\Controllers;

use Ceb\Factories\ContributionFactory;
use Ceb\Factories\MemberTransactionsFactory;
use Ceb\Factories\RefundFactory;
use Ceb\Http\Controllers\Controller;
use Ceb\Http\Requests\AddNewMemberRequest;
use Ceb\Http\Requests\CompleteMemberTransactionRequest;
use Ceb\Http\Requests\EditMemberRequest;
use Ceb\Models\Institution;
use Ceb\Models\User;
use Ceb\Repositories\Member\MemberRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Redirect;
use Response;

class MemberController extends Controller {
	public $member;
	function __construct(User $member) {
		$this->middleware('sentry.auth');
		$this->member = $member;
		parent::__construct();
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {

		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('member.list')) {
			flash()->error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}

		// First log
		Log::info($this->user->email . ' viewed member list');

		$members = $this->member->paginate(20);

		return view('members.list', compact('members'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Institution $institutions) {
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('member.create')) {
			flash()->error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}
		$member = $this->member;
		$institutions = $institutions->lists('name', 'id');

		return view('members.create', compact('member', 'institutions'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(AddNewMemberRequest $request, MemberRepositoryInterface $memberRepository) {
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('member.create')) {
			flash()->error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}
		$message = $memberRepository->store($request->all());
		flash()->success($message);
		return Redirect::route('members.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('member.view')) {
			flash()->error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}

		$member = $this->member->findOrfail($id);

		return view('members.edit', compact('member'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Institution $institutions) {
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('member.edit')) {
			flash()->error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}

		$member = $this->member->findOrfail($id);
		$institutions = $institutions->lists('name', 'id');

		return view('members.edit', compact('member', 'institutions'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(EditMemberRequest $request, MemberRepositoryInterface $memberRepository, $id) {

		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('member.edit')) {
			flash()->error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}

		// First prepare data
		$data = (array) $request->all();
		$data['id'] = $id;

		// Attempt update
		$message = $memberRepository->update($data);

		flash()->success($message);

		return Redirect::route('members.edit', ['members' => $id]);
	}

	/**
	 * Contribution of  this member
	 * @param  int        $memberId unique ID of this member
	 * @param  RefundFactory $refund   
	 * @return redirect
	 */
	public function contribute($memberId,ContributionFactory $contribution)
	{
		if (!$contribution->setMember($memberId)) {
			return redirect()->back();
		}

	   return redirect()->route('contributions.index');
	}

	/**
	 * refund this member
	 * @param  int        $memberId unique ID of this member
	 * @param  RefundFactory $refund   
	 * @return redirect
	 */
	public function refund($memberId,RefundFactory $refund)
	{
		if (!$refund->setMember($memberId)) {
			return redirect()->back();
		}

	   return redirect()->route('refunds.index');
	}
  	
  	/**
  	 * Show member loan records
  	 * @param  numeric $memberId the ID of the member
  	 * @return view    
  	 */
    public function loanRecords($memberId)
    {
    	$member = $this->member->findOrfail($memberId);
	    $report = view('reports.member.loan_records',compact('member'))->render();
		return view('layouts.printing', compact('report'));
    }
    /**
     * Show this member contribution
     * @param  numeric $memberId [description]
     * @return view       
     */
    public function contributions($memberId)
    {
    	$member = $this->member->findOrfail($memberId);
    	$report = view('reports.member.contributions',compact('member'))->render();
    	return view('layouts.printing', compact('report'));
    }

	/**
	 * This method shows transaction form
	 * @return view 
	 */
	public function transacts($memberId)
	{
		$member = $this->member->findOrfail($memberId);
		return view('members.transactions',compact('member'));
	}

	/**
	 * This method complete transaction
	 * @return redirect
	 */
	public function completeTransaction($memberId,CompleteMemberTransactionRequest $request,MemberTransactionsFactory $factory)
	{
		 $data = $request->all();

		 $data['member'] = $this->member->findOrfail($memberId);

		 if ($factory->complete($data)) {
		 	return response(trans('member.transaction_well_recorded'),200);
		 }

		 $errors  = array('errors' => json_encode(Session::get('flash_notification.message')) );

		 Session::forget('flash_notification.message'); // remove any error in the dd

		 $errors  = json_encode($errors);
		 // Error happened here
		 return response($errors,422);
	}
    
    /**
	 * This method shows transaction form
	 * @return view 
	 */
	public function attornies($memberId)
	{
		$member = $this->member->findOrfail($memberId);
		return view('members.attornies',compact('member'));
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(MemberRepositoryInterface $memberRepository, $id) {
		// First check if the user has the permission to do this
		if (!$this->user->hasAccess('member.delete')) {
			flash()->error(trans('Sentinel::users.noaccess'));

			return redirect()->back();
		}

		$message = $memberRepository->destroy($id);
		flash()->success($message);
		return Redirect::route('members.index', ['success' => $message]);
	}

	/**
	 * Search method for member
	 * @param  MemberRepository $member
	 * @param  Request          $request
	 * @return [type]
	 */
	public function search(MemberRepositoryInterface $member, Request $request) {
        
		$results = $member->search($request->input('query'));
      
		return Response::json($results);
	}

}
