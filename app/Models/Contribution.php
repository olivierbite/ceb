<?php

namespace Ceb\Models;
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
