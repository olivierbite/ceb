<?php

namespace Ceb\Models;

use Ceb\Traits\EloquentDatesTrait;

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
		'charged_amount',
		'charged_percentage',
	];


	/**
	 * Relationship with member
	 * @return Ceb\Models\User
	 */
	public function member()
	{
		return $this->belongsTo('Ceb\Models\User','adhersion_id','adhersion_id');
	}
		/**
	 * Relationship with member
	 * @return Ceb\Models\User
	 */
	public function institution()
	{
		return $this->belongsTo('Ceb\Models\Institution');
	}

	 /**
    * Get loan postings
    * @return  
    */
   public function postings()
   {
   	return $this->hasMany('\Ceb\Models\Posting','transactionid','transactionid');
   }
	/**
     * Get transactionType
     * @param  $query
     * @param  $date 
     * @return \Illuminate\Database\Eloquent\Builder
     */
	public function scopeOfTransactionType($query,$transactionType)
	{
		return $query->where('transaction_type',$transactionType);
	}


	/**
	 * Get Contribution by transaction ID
	 * @param  $query         
	 * @param  $transactionId 
	 * @return mixed
	 */	
	public function scopeByTransaction($query,$transactionid)
	{
		return $query->where('transactionid','=',"$transactionid");
	}

	/**
     * Get transactionType of saving
     * @param  $query
     * @param  $date 
     * @return \Illuminate\Database\Eloquent\Builder
     */
	public function scopeIsSaving($query)
	{
		return $query->where('transaction_type','saving');
	}

	/**
     * Get transactionType of saving
     * @param  $query
     * @param  $date 
     * @return \Illuminate\Database\Eloquent\Builder
     */
	public function scopeIsWithdrawal($query)
	{
		return $query->where('transaction_type','withdrawal');
	}

	/**
     * Get record after a given id
     * @param  $query
     * @param  $date 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFor($query,$adhersion_id)
    {
    	return $query->where('adhersion_id',$adhersion_id);
    }
}
