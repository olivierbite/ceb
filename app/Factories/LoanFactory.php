<?php
namespace Ceb\Factories;
use Ceb\Models\User;
use Illuminate\Support\Facades\Session;

/**
 * This factory helps Contribution
 */
class LoanFactory {

	function __construct(Session $session, User $member) {
		$this->session = $session;
		$this->member = $member;
	}

	/** Add member to is going to receive loan */
	function addMember($memberId) {
		$member = $this->member->find($memberId);
		Session::put('loan_member', $member);
	}

	/** Get member who is going to receive the loan */
	function getMember() {
		return Session::get('loan_member', new $this->member);
	}

	function cancel() {
		$this->clearAll();
	}
	private function clearAll() {
		Session::forget('loan_member');
	}
}