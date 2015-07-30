<?php

namespace Ceb\Models;

use Ceb\Models\Contribution;
use Illuminate\Database\Eloquent\Model;

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
		return $this->hasMany('Ceb\Models\User', 'adhersion_id', 'adhersion_id');
	}

	/**
	 * Get the total amount of contribution
	 */
	public function totalContributions() {
		return Contribution::where('adhersion_id', $this->adhersion_id)
			->get()
			->sum('amount');
	}

	/**
	 * Get Right to loan
	 */
	public function rightToLoan() {
		return $this->totalContributions() * 2.5;
	}

	/**
	 * Find a member by his adhersion ID
	 * @param  integer $adhersionId member adhersion number
	 * @return this         
	 */
	public function findByAdhersion($adhersionId)
	{
		return $this->where('adhersion_id',$adhersionId)->first();
	}
}
