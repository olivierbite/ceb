<?php

namespace Ceb\Models;

class Loan extends Model {
		/**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
	protected $dates = ['created_at', 'updated_at', 'letter_date'];
	
	// fillable
	protected $fillable = [
		'transactionid',
		'loan_contract',
		'adhersion_id',
		'movement_nature',
		'operation_type',
		'letter_date',
		'right_to_loan',
		'wished_amount',
		'loan_to_repay',
		'interests',
		'InteretsPU',
		'amount_received',
		'tranches_number',
		'monthly_fees',
		'cheque_number',
		'bank_id',
		'security_type',
		'cautionneur1',
		'cautionneur2',
		'average_refund',
		'amount_refounded',
		'comment',
		'special_loan_contract_number',
		'remaining_tranches',
		'special_loan_tranches',
		'special_loan_interests',
		'special_loan_amount_to_receive',
		'user_id',
		'status',
		'urgent_loan_interests',
		'factor',
		'rate',
	];

	/**
	 * Get the member who were given this loan
	 * @return User Object
	 */
   public function member()
   {
   	return $this->belongsTo('\Ceb\Models\User','adhersion_id','adhersion_id');
   }

	/**
	 * Cautionneur 1
	 * @return Objects cautionneur 1
	 */
	public function getCautionneur1() {
		return $this->hasOne('Ceb\Models\User','id', 'cautionneur1');
	}

	/**
	 * Cautionneur 2
	 * @return Objects cautionneur 2
	 */
	public function getCautionneur2() {
		return $this->hasOne('Ceb\Models\User','id', 'cautionneur2');
	}

	/**
	 * Refunds done to this loan
	 * @return object 
	 */
	public function refunds()
	{
		return $this->hasMany('Ceb\Models\Refund','loan_id','id');
	}

	/**
	 * Get Loan balance
	 *
	 * @return numeric 
	 */
	public function balance()
	{
		return $this->loan_to_repay - $this->refunds()->sum('amount');
	}

	/**
	 * Get balance 
	 * 
	 * @return 
	 */
	public function getBalanceAttribute()
	{
		return $this->loan_to_repay - $this->refunds()->sum('amount');
	}

	/**
	 * Determine if this loan is full paid
	 *
	 * @return bool
	 */
	public function isFullPaid()
	{
		return $this->balance() <= 0;
	}

	/**
	 * Scope to determine if the loan is full paid
	 * 
	 * @return ;
	 */
	public function scopeIsFullPaid()
	{
		return $this->balance() <= 0;
	}
	/** 
	 * Get refund by adhersion ID
	 *
	 * @return Object
	 */
	public function refundsByAdhersion()
	{
		return $this->hasMany('Ceb\Models\Refund','adhersion_id','adhersion_id');
	}

	/**
	 * Find loan by transaction id
	 * @param  query scope $query     
	 * @param  string $transactionId 
	 * @return this
	 */
	public function scopeFindByTransaction($query,$transactionId)
	{
		return $query->where('transactionid','=',$transactionId);
	}

	/**
     * Scope a query to only include users of a given type(ordinary loan/ urgent , special etc...).
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('operation_type', $type);
    }

	/**
     * Scope a query to only include loans of a given status.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfStatus($query, $status)
    {
        return $query->where('status', $status);
    }

	/**
     * Scope a query to only include approved loans.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeApproved($query)
    {
        return $query->where('status', '=','approved');
    }

    /**
     * Scope a query to only include pending loans.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePending($query)
    {
        return $query->where('status', '=','pending');
    }

    /**
     * Scope a query to only include rejected loans.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRejected($query)
    {
        return $query->where('status', '=','rejected');
    }
}
