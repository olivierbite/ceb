<?php

namespace Ceb\Models;

use Ceb\Models\Contribution;

class User extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'adhersion_id',
		'district',
		'province',
		'institution_id',
		'service',
		'termination_date',
		'first_name',
		'last_name',
		'password',
		'date_of_birth',
		'sex',
		'member_nid',
		'nationality',
		'email',
		'telephone',
		'monthly_fee',
		'photo',
		'signature',
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	/** Get member names */
	public function names() {
		return $this->first_name . ' ' . $this->last_name;
	}
	/**
	 * Member institution
	 * @return Ceb\Models\Institution
	 */
	public function institution() {
		return $this->belongsTo('Ceb\Models\Institution');
	}
	/**
	 * Get the contributions for the Member.
	 */
	public function contributions() {
		return $this->hasMany('Ceb\Models\Contribution', 'adhersion_id', 'adhersion_id');
	}

	/**
	 * Get member loans
	 */
	public function loans() {
		return $this->hasMany('Ceb\Models\Loan', 'adhersion_id', 'adhersion_id');
	}
	/**
	 * Member refunds
	 * @return Objects contains all refunds by this memebr
	 */
	public function refunds() {
		return $this->hasMany('Ceb\Models\Refund', 'adhersion_id', 'adhersion_id');
	}

	/**
	 * Get total refunds by this member;
	 * @return numeric
	 */
	public function totalRefunds() {
		return $this->refunds()->sum('amount');
	}
	/**
	 * Get the total amount of contribution
	 */
	public function totalContributions() {
		return $this->contributions()->sum('amount');
	}
	/**
	 * Get the loan balance
	 * @return numeric
	 */
	public function loanBalance() {
		return $this->totalLoans() - $this->totalRefunds();
	}
	/**
	 * Determine if this member has active Loan
	 *
	 * @return  bool
	 */
	public function hasActiveLoan() {
		return $this->loanBalance() > 0;
	}

	/**
	 * Get Right to loan
	 */
	public function rightToLoan() {
		return $this->totalContributions() * 2.5;
	}

	/**
	 * total Loan that user has taken
	 * @return  numeric
	 */
	public function totalLoans() {
		return $this->loans()->sum('loan_to_repay');
	}

	/**
	 * Get member loan monthly fees that
	 * He is supposed to pay
	 * @return numeric with the fees this member need to pay
	 */
	public function loanMonthlyFees() {
		return $this->loans()->orderBy('created_at', 'desc')->first()->monthly_fees;
	}
	/**
	 * Find a member by his adhersion ID
	 * @param  integer $adhersionId member adhersion number
	 * @return this
	 */
	public function findByAdhersion($adhersionId) {
		return $this->where('adhersion_id', $adhersionId)->first();
	}
}
