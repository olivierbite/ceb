<?php

namespace Ceb\Models;
class Refund extends Model {

	protected $fillable = [
		'adhersion_id',
		'contract_number',
		'month',
		'amount',
		'tranches_number',
		'transaction_id',
		'member_id',
		'wording',
		'user_id',
		'loan_id',
		];


	/**
	 * Get loan by which this Refund belongs to
	 * 
	 * @return object
	 */
	public function loan()
	{
		return $this->belongsTo('Ceb\Models\Loan','loan_id','id');
	}

	/** 
	 * Get refund by adhersion ID
	 *
	 * @return Object
	 */
	public function loanByAdhersion()
	{
		return $this->hasMany('Ceb\Models\Loan','adhersion_id','adhersion_id');
	}
}
