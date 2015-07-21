<?php

namespace Ceb\Models;

use Illuminate\Database\Eloquent\Model;

class Contribution extends Model {
	//
	//
	protected $fillable = [
		'adhersion_id',
		'institution_id',
		'month',
		'amount',
		'state',
		'transactionid',
	];
}
