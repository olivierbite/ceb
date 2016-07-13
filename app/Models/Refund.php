<?php

namespace Ceb\Models;

use Illuminate\Support\Facades\DB;
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
    * Get loan postings
    * @return  
    */
   public function postings()
   {
   	return $this->hasMany('\Ceb\Models\Posting','transactionid','transaction_id');
   }
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

	/**
     * Sum  outstanding loan amount
     * @return number;
     */
    public function sumRefunds()
    {
    	$sum=  DB::select("select sum(amount) as amount FROM refunds");
    	
     	return array_shift($sum)->amount;
    }

    public static function octroye()
    {
    	// GET LOANS 
    	DB::statement('DROP TABLE IF EXISTS TEMP_LOANS_PER_MEMBER');
    	DB::statement("CREATE TEMPORARY TABLE TEMP_LOANS_PER_MEMBER
						(
							 SELECT 
									adhersion_id,
						            SUM(loan_to_repay) as loan 
							 FROM loans 
						     WHERE STATUS ='approved' GROUP BY adhersion_id
						)");

        // GET REFUNDS
        DB::statement('DROP TABLE IF EXISTS TEMP_REFUND_PER_MEMBER');
        DB::statement("CREATE TEMPORARY TABLE TEMP_REFUND_PER_MEMBER
						(
							SELECT adhersion_id,sum(amount) refund FROM refunds GROUP BY adhersion_id
						)");

        // GET THE REPORT
        $result = DB::select("SELECT  CASE 
								WHEN c.first_name IS NULL THEN c.last_name
					            WHEN c.last_name  IS NULL THEN c.first_name
							ELSE CONCAT(c.first_name,' ',c.last_name) END AS names,
						        a.adhersion_id,
						        a.loan,
						        b.refund,
								a.loan - b.refund AS balance
							FROM TEMP_LOANS_PER_MEMBER AS a
					        LEFT JOIN TEMP_REFUND_PER_MEMBER AS b ON a.adhersion_id = b.adhersion_id AND b.refund >= a.loan
					        AND b.refund IS NOT NULL
					        LEFT JOIN  users AS c ON a.adhersion_id = c.adhersion_id");

        return $result;
    }
    /**
     * Get Iregularities
     * @param  integer $months
     * @return 
     */
    public function refundIrregularities($months = 3)
    {
    	/** GETTING ALL MEMBERS LOANS **/
    	DB::statement('DROP TABLE IF EXISTS TEMP_memberloans');
		DB::statement('CREATE TEMPORARY TABLE TEMP_memberloans
						(
						SELECT adhersion_id,sum(loan_to_repay) loansAmount FROM loans where `status` = \'approved\' group by adhersion_id
					);');


		/** GETTING ALL MEMBERS REFUNDS **/
		DB::statement('DROP TABLE IF EXISTS TEMP_memberrefunds');
		DB::statement('CREATE TEMPORARY TABLE TEMP_memberrefunds
						(
						SELECT adhersion_id,sum(amount) refundedAmount FROM refunds group by adhersion_id
						);'
					);
		/** GETTING MEMBER WITH LOANS **/
		DB::statement('DROP TABLE IF EXISTS TEMP_members_with_active_loans');
		DB::statement('CREATE TEMPORARY TABLE TEMP_members_with_active_loans
						(
						 SELECT a.adhersion_id,loansAmount,refundedAmount,first_name,last_name,service FROM TEMP_memberloans AS a,
						 TEMP_memberrefunds as b,
						 users c WHERE  a.loansAmount > b.refundedAmount AND a.adhersion_id = b.adhersion_id
						 AND  a.adhersion_id = c.adhersion_id
						);'
					);

		DB::statement('DROP TABLE IF EXISTS TEMP_member_latest_refund');
		DB::statement('CREATE TEMPORARY TABLE TEMP_member_latest_refund
						(
						SELECT * FROM
									(
									SELECT 
											adhersion_id,
									        max(created_at) as last_date
											FROM refunds 
											GROUP BY 
											adhersion_id
									) AS a
									WHERE 
									/* Smaller or equal than one month ago */
									last_date < DATE_SUB(NOW(), INTERVAL '.$months.' MONTH)
						);'
					);

		DB::statement('DROP TABLE IF EXISTS TEMP_member_latest_loan');
		DB::statement('CREATE TEMPORARY TABLE TEMP_member_latest_loan
						(
						SELECT a.adhersion_id, a.monthly_fees,a.comment FROM loans as a,
						(SELECT * FROM
									(
									SELECT 
											adhersion_id,
									        max(id) as id
											FROM loans 
						                    WHERE `status` =\'approved\'
											GROUP BY 
											adhersion_id
									) AS a
						 ) as b
						 WHERE a.id = b.id AND a.adhersion_id = b.adhersion_id
						);'
					);

		DB::statement('DROP TABLE IF EXISTS TEMP_contributions');
		DB::statement('CREATE TEMPORARY TABLE TEMP_contributions
						(
								SELECT a.adhersion_id,
								   CASE 
									WHEN withdrawal_amount IS NULL THEN contributed_amount
                                    ELSE contributed_amount - withdrawal_amount 
                                    END AS contributed_amount,
								    a.last_date
                                   FROM  (
                                       SELECT 
											adhersion_id,
									        sum(amount) as contributed_amount,
									        max(created_at) as last_date
											FROM contributions 
									        WHERE transaction_type = \'saving\'
												GROUP BY 
											adhersion_id) as a
								LEFT JOIN
								(
                                 SELECT adhersion_id,
									    sum(amount) as withdrawal_amount 
								 FROM contributions WHERE transaction_type = \'withdrawal\'
								) as b 
                                ON a.adhersion_id=b.adhersion_id
						);');


		$query = 'SELECT a.adhersion_id,
								       a.first_name,
								       a.last_name,
								       a.service,
								       loansAmount,
								       refundedAmount,
								       b.last_date,
								       c.monthly_fees,
								       c.comment,
								       d.contributed_amount 
								FROM TEMP_members_with_active_loans as a,
								TEMP_member_latest_refund as b,
								 TEMP_member_latest_loan c,
								 TEMP_contributions as d
								WHERE   a.adhersion_id = b.adhersion_id 
								AND   b.adhersion_id = c.adhersion_id 
								AND  b.adhersion_id = d.adhersion_id';
							
		return DB::select(DB::raw($query));
    }
    
}
