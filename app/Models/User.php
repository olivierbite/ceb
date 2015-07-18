<?php

namespace Ceb\Models;

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

	public function institution() {
		return $this->belongsTo('Ceb\Models\Institution');
	}

}
