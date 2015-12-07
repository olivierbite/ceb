<?php

namespace Ceb\Models;

use Ceb\Traits\EloquentDatesTrait;
use Illuminate\Support\Facades\DB;

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
		return $query->where('transactionid',$transactionid);
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


    /**
     * Method to generate niveaut d'epargne report
     * @return array
     */
    public function savingLevel()
    {
    	$query = "
				SELECT  a.adhersion_id,a.first_name,a.last_name,a.institution,a.service,amount as savings FROM 
				(SELECT a.adhersion_id,a.first_name,a.last_name,b.name as institution,service FROM users as a,
				institutions b where a.institution_id = b.id) as a
					LEFT JOIN 
				(SELECT adhersion_id,CASE WHEN transaction_type = 'withdrawal' then sum(-1*amount) else sum(amount) end as amount from  contributions group by adhersion_id)
				c ON a.adhersion_id = c.adhersion_id;
				";

		return DB::select($query);
    }

    /**
     * Get people who didnt contribute in x amount of months
     * @param  integer $months last x months without contributions
     * @return   array
     */
    public function notContributedIn($months = 3)
    {
    	$query = "
    			/** GETTING PEOPLE WHO SPENT  MORE THAN 3 MONTHS WITHOUT CONTRIBUTION **/
			SELECT  a.*,b.first_name,b.last_name,b.service,a.contributed_amount,(a.contributed_amount + (b.monthly_fee *TIMESTAMPDIFF(MONTH, last_date,CURDATE()))) as to_pay FROM 
			(SELECT * FROM
			(
			SELECT 
					adhersion_id,
			        max(amount) as contributed_amount,
			        max(created_at) as last_date
					FROM contributions 
			        WHERE transaction_type = 'saving'
						GROUP BY 
					adhersion_id
			) AS a
			WHERE 
			/* Smaller or equal than one month ago */
			last_date < DATE_SUB(NOW(), INTERVAL $months MONTH)
			) as a
			LEFT JOIN 
			users b
			ON a.adhersion_id = b.adhersion_id
			";
		return DB::select($query);
    }
}
