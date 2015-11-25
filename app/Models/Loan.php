<?php

namespace Ceb\Models;

use Illuminate\Support\Facades\DB;

class Loan extends Model {
	
	/**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
	protected $dates = ['created_at', 'updated_at', 'letter_date'];
	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
	    'is_regulation' => 'boolean',
	];
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
		'reason',
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
    * Get loan postings
    * @return  
    */
   public function postings()
   {
   	return $this->hasMany('\Ceb\Models\Posting','transactionid','transactionid');
   }

   /**
    * Get cautionneurs
    * @return collection
    */
   public function cautions()
   {
   		return $this->hasMany('Ceb\Models\MemberLoanCautionneur', 'transaction_id', 'transaction_id');
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
     * Get ordinary loan
     * @param  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsOrdinary($query)
    {
    	return $query->where('operation_type','LIKE','%ordinary_loan');
    }

    /**
     * Get loan, that still has more right to loan
     * @param  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHasMoreRightToLoan($query)
    {
    	return $query->where('loan_to_repay','<','right_to_loan');
    }

    /**
     * Get right to loan attribute
     * @return  
     */
    public function getRemainingRightToLoanAttribute()
    {
    	return $this->right_to_loan - $this->loan_to_repay;
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

     /**
     * Scope a query to only get blocked loans, which are considered if there is no bank or cheque.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBlocked($query)
    {
    	return $query->where(function($query)
    				{
    				 return $query->where('cheque_number','')
				    				 ->orWhereNull('cheque_number')
				    				 ->orWhereNull('bank_id')
				    				 ->orWhere('bank_id','');
    				})
    				 ->where('regulation_type','<>','installments');
    }

     /**
     * Scope a query to only get unblocked loans, which are considered if there is no bank or cheque.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnBlocked($query)
    {
    	return $query->where(function($query)
							{
								return $query->where(function($query){
													return $query->where('cheque_number','<>','')
																->whereNotNull('cheque_number')
																->whereNotNull('bank_id')
																->where('bank_id','<>','');
							})
							->orWhere(function($query)
									{
									return $query->where('regulation_type','	=','installments')
												->where('is_regulation',1);
									});
							});
    }

    /**
     * Count paid loans
     * @return number;
     */
    public function countPaid()
    {
    	$count=  DB::select("SELECT count(1) as count
    						FROM 
								(SELECT adhersion_id,sum(loan_to_repay) loan FROM loans where status = 'approved' group by adhersion_id) 
									as a
							LEFT JOIN 
								(SELECT adhersion_id,sum(amount) refund FROM refunds group by adhersion_id) 
						     	   as b
							ON a.adhersion_id = b.adhersion_id 
							WHERE a.loan <= b.refund
						");

     	return array_shift($count)->count;
    }

    /**
     * Count loan with outstanding money
     * @return number;
     */
    public function countOutStanding()
    {
    	$count=  DB::select("SELECT count(1) as count
    						FROM 
								(SELECT adhersion_id,sum(loan_to_repay) loan FROM loans where status = 'approved' group by adhersion_id) 
									as a
							LEFT JOIN 
								(SELECT adhersion_id,sum(amount) refund FROM refunds group by adhersion_id) 
						     	   as b
							ON a.adhersion_id = b.adhersion_id
							WHERE a.loan > b.refund
						");

     	return array_shift($count)->count;
    }

    /**
     * Sum  outstanding loan amount
     * @return number;
     */
    public function sumOutStanding()
    {
    	$sum=  DB::select("SELECT sum(a.loan_to_repay) - sum(b.amount) as amount
	    						FROM 
									(select sum(loan_to_repay) as loan_to_repay FROM loans WHERE status = 'approved') as a,
									refunds as b 
						   ");

     	return array_shift($sum)->amount;
    }
}
