<?php

namespace Ceb\Models;
class Contribution extends Model {
	
	protected $fillable = [
		'adhersion_id',
		'institution_id',
		'month',
		'amount',
		'state',
		'transactionid',
		'year',
		'contract_number',
		'transaction_type',
		'transaction_reason',
		'wording',
	];


	/**
	 * Relationship with member
	 * @return Ceb\Models\User
	 */
	public function member()
	{
		return $this->belongsTo('Ceb\Models\User','adhersion_id','adhersion_id');
	}
}
