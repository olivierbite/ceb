<?php

namespace Ceb\Http\Controllers;

use Ceb\Http\Controllers\Controller;
use Ceb\Models\User;

class ReportController extends Controller {
	function __construct(User $member) {
		$this->member = $member;
	}

	public function index() {
		return view('reports.index');
	}

	/**
	 * Show saving contract letter
	 * @param  $memberId ID of the member we are reporting for
	 * @return
	 */
	public function contractSaving($memberId) {
		$member = $this->getMember($memberId);
		$report = view('reports.contracts_saving', compact($member))->render();
		return view('layouts.printing', compact('report'));
	}
	/**
	 * Get loan contract number
	 * @param  $memberId
	 * @return mixed
	 */
	public function contractLoan($memberId) {
		$member = $this->getMember($memberId);
		$report = view('reports.contracts_loan', compact($member))->render();
		return view('layouts.printing', compact('report'));
	}

	/**
	 * Get member by his ID
	 * @param  INTEGER $memberId [description]
	 * @return Model
	 */
	private function getMember($memberId) {
		// Do we have the member we are looking for ?
		if (($member = $this->member->find($memberId)) == null) {
			flash()->error(trans('member.member_not_found'));
			return false;
		}
		return $member;
	}
}
