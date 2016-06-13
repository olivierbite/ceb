<?php

namespace Ceb\Models;

use Illuminate\Database\Eloquent\Collection;
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
        'is_umergency',
        'emergency_refund',
        'emergency_balance',
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
   		return $this->hasMany('Ceb\Models\MemberLoanCautionneur', 'transaction_id', 'transactionid');
   }

    /**
     * Get cautionneur 1
     * @return Collection
     */
    public function getCautionneur1Attribute()
    {
    	return $this->cautions()->get()->first();
    }

    /**
     * Get cautionnuer 2
     * @return Collection 
     */
    public function getCautionneur2Attribute()
    {
    	return $this->cautions()->get()->last();
    }

    /**
     * Get calculated monthly fees attribute
     * @return numeric
     */
    public function getCalculatedMonthlyFeeAttribute()
    {
    if (trim(strtolower($this->operation_type))=='special_loan') {
        try
        {
         $previous = \DB::select("SELECT * FROM loans WHERE status='approved' AND is_umergency = 0 AND id < ? order by id desc LIMIT 1", [$this->id]);

            return $this->monthly_fees - $previous[0]->monthly_fees;
        }
        catch(\Exception $ex)
        {
            Log::critical($ex->getMessage());
        }
        }

        return $this->monthly_fees;
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
    	return $query->where('operation_type','LIKE','%ordinary_loan')
    				 ->where('status','approved');
    }


    /**
     * Get ordinary loan
     * @param  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsNotReliquant($query)
    {
        return $query->where('operation_type','<>','loan_relicat')
                     ->where('status','approved');
    }

    /**
     * Get emergency loan
     * @param  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getEmergencyMonthlyFeeAttribute()
    {
        /** Make sure this is a valid emergency loan before proceeding */
        if ($this->operation_type == 'emergency_loan' && $this->emergency_balance>0) {
            try
            {
                return $this->loan_to_repay / $this->tranches_number ;
            }
            catch (\Exception $e){
                return $this->monthly_fees;
            }
        }

        return 0;
    }

    /**
     * Get emergency loan
     * @param  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsUmergency($query)
    {
        return $query->where('operation_type','=','emergency_loan')
                     ->where('is_umergency',1)
                     ->where('status','approved');
    }

    /**
     * Get emergency loan
     * @param  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsNotUmergency($query)
    {
        return $query->where('operation_type','<>','emergency_loan')
                     ->where('is_umergency',0);
    }


    /**
     * Get paid emergency loan
     * @param  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsPaidUmergency($query)
    {
        return $query->where('operation_type','LIKE','emergency_loan')
                     ->where('is_umergency',1)
                     ->where('emergency_balance',0)
                     ->where('status','approved');
    }
    
    /**
     * Get not paid emergency loan
     * @param  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsNotPaidUmergency($query)
    {
        return $query->where('operation_type','LIKE','emergency_loan')
                     ->where('is_umergency',1)
                     ->where('emergency_balance','>',0)
                     ->where('status','approved');
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
	 * Get loan by transaction ID
	 * @param  $query         
	 * @param  $transactionId 
	 * @return mixed
	 */	
	public function scopeByTransaction($query,$transactionid)
	{
		return $query->where('transactionid',$transactionid);
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
    	return $query->where('status','pending');
    }

     /**
     * Scope a query to only get unblocked loans, which are considered if there is no bank or cheque.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnBlocked($query)
    {
    	return $query->where('status','unblocked');
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
									(select sum(amount) as amount FROM refunds ) as b 
						   ");
    	
     	return array_shift($sum)->amount;
    }

    /**
     * Get members with loans
     * @param  string $institition 
     * @return array 
     */
    public function memberWithLoans($institition = '')
    {
    	// if user passed institution then consider it in the select
    	if (!empty($institition)) {

    		$institition = " AND institution_id = ".$institition;
    	}

    	$query = "SELECT a.*,CASE WHEN b.emergency_fees IS NULL THEN 0 ELSE b.emergency_fees END AS emergency_fees
    FROM (
                                SELECT withloans.adhersion_id,first_name,last_name,service,monthly_fees 
                                FROM 
                                    (
                                    SELECT a.adhersion_id,first_name,last_name,service FROM 
                                    (
                                    SELECT sum(amount) refunds,adhersion_id FROM refunds  group by adhersion_id) AS a,
                                    (SELECT sum(loan_to_repay) loan,adhersion_id FROM loans where `status` ='approved'  group by adhersion_id) as b
                                     ,users
                                      WHERE loan > refunds and a.adhersion_id = b.adhersion_id and a.adhersion_id = users.adhersion_id
                                       $institition
                                    ) withloans,

                                    (SELECT b.adhersion_id,monthly_fees from loans as a,
                                    (SELECT adhersion_id,max(created_at)  as latestloandate from loans where `status` ='approved' and operation_type <> 'loan_relicat' and operation_type <> 'emergency_loan' group by adhersion_id) as b
                                    WHERE a.adhersion_id = b.adhersion_id and a.created_at= latestloandate
                                    ) latestloan
                                    where withloans.adhersion_id = latestloan.adhersion_id
                                ) AS a
                                 LEFT JOIN 
                                (
                                SELECT 
                                adhersion_id,monthly_fees emergency_fees 
                                FROM loans WHERE is_umergency = 1 AND `status`='approved'  
                                AND emergency_refund < (monthly_fees * tranches_number) 
           
                                ) AS b
                                ON a.adhersion_id= b.adhersion_id;";
    	return DB::select($query);
    }

    /**
     * Get member loan balance
     * @return 
     */
    public function getMembersLoanBalance()
    {
        DB::statement('DROP TABLE IF EXISTS TEMP_MEMBER_LOAN_REFUND');
        DB::statement('CREATE TEMPORARY TABLE TEMP_MEMBER_LOAN_REFUND(
                        SELECT a.adhersion_id,
                              CASE WHEN sum_refund is null THEN sum_loan ELSE sum_loan  - sum_refund end as balance FROM
                        (
                            SELECT adhersion_id,sum(loan_to_repay) as sum_loan FROM 
                                loans as a where a.status=\'approved\' group by adhersion_id) as a
                            LEFT JOIN 
                        (
                            SELECT adhersion_id,case when sum(amount) is null then 0 else sum(amount) end as sum_refund 
                                FROM refunds group by adhersion_id) as b 
                            ON a.adhersion_id = b.adhersion_id
                        );'
                    );

        $query = 'SELECT a.adhersion_id,balance,first_name,last_name,service,c.name institution 
                  FROM TEMP_MEMBER_LOAN_REFUND as a
                  LEFT JOIN users as b on a.adhersion_id = b.adhersion_id
                  LEFT JOIN institutions as c on b.institution_id = c.id   WHERE balance > 0 ';

        $results = DB::select(DB::raw($query));
        return new Collection($results);
    }

    /**
     * Get loan records per adhersion_id
     * @param  string $adhersion_id 
     * @return array             
     */
    public function getLoanRecords($adhersion_id =null)
    {
         return DB::select('call SP_LOAN_RECORDS(?)',array($adhersion_id));
    }
}
