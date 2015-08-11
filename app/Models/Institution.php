<?php

namespace Ceb\Models;

class Institution extends Model {

	public function members() {
		return $this->hasMany('Ceb\Models\User');
	}

	/**
	 * Get member with loan
	 * @return Eloquent Object
	 */
	public function membersWithLoan() {
		$membersWithLoans = [];
		/** Make sure we only get member with loan */
		foreach ($this->members as $member) {

			if ($member->hasActiveLoan()) {
				$membersWithLoans[] = $member;
			}
		}
		return $membersWithLoans;
	}

	/**
	 * Get list of members with No active Loan
	 * @return Object of members
	 */
	public function membersWithNoLoan() {
		$membersWithNoLoan = [];
		/** Make sure we only get member with loan */
		foreach ($this->members as $member) {
			if (!$member->hasActiveLoan()) {
				$membersWithNoLoan[] = $member;
			}
		}
		return $membersWithNoLoan;
	}
}
