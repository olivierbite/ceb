<?php

namespace Ceb\Http\Controllers;

use Illuminate\Http\Request;
use Ceb\Http\Requests;
use Ceb\Http\Controllers\Controller;
use Ceb\Models\User;
class ReportController extends Controller
{
	function __construct(User $member) {
		$this->member = $member;
	}

    public function index()
    {
    	return view('reports.index');
    }
    
    /**
     * Show saving contract letter
     * @param  $memberId ID of the member we are reporting for
     * @return
     */
    public function contractSaving($memberId)
    {
    	$member = $this->getMember($memberId);
    	return view('reports.contracts_saving',compact(varname));
    }
    /**
     * Get loan contract number
     * @param  $memberId 
     * @return mixed
     */
    public function contractLoan($memberId)
    {
    	$member  = $this->getMember($memberId);
    	return view('reports.contracts_loan');
    }

    /**
     * Get member by his ID
     * @param  INTEGER $memberId [description]
     * @return Model
     */
    private function member($memberId)
    {
    	// Do we have the member we are looking for ?
    	if (($member = $this->member->find($memberId)) == null) {
    		flash()->error(trans('member.member_not_found'));
    		return false;
    	}
    	return $member;
    }
}
