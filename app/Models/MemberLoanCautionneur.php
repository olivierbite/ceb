<?php

namespace Ceb\Models;

class MemberLoanCautionneur extends Model {
	
	protected  $table = 'member_loan_cautionneurs';


	/**
	 * Get the member who were given this loan
	 * @return User Object
	 */
   public function member()
   {
	   	return $this->belongsTo('\Ceb\Models\User','member_adhersion_id','adhersion_id');
   }

   	/**
	 * Get the member who has this caution
	 * @return User Object
	 */
   public function cauttionneur()
   {
	   	return $this->belongsTo('\Ceb\Models\User','cautionneur_adhresion_id','adhersion_id');
   }

	/**
	 * Get caution details by loan Id
	 * @param  $query  
	 * @param  $loanId 
	 * @return Illumunate\Support\Querybuilder
	 */
	public function scopeByLoanId($query,$loanId)
	{
		return $query->where('loan_id',$loanId);
	}

	/**
	 * Get caution details by adhersion Id
	 * @param  $query  
	 * @param  $adhersion_id 
	 * @return Illumunate\Support\Querybuilder
	 */
	public function scopeByAdhersion($query,$adhersionId)
	{
		return $query->where('member_adhersion_id',$adhersionId);
	}

	/**
	 * Get caution details by adhersion Id
	 * @param  $query  
	 * @param  $adhersion_id 
	 * @return Illumunate\Support\Querybuilder
	 */
	public function scopeByTransaction($query,$transactionId)
	{
		return $query->where('transaction_id',$transactionId);
	}

	/**
	 * Get member with active caution
	 * @return query builder
	 */
	public function scopeActive($query)
	{
		return $query->where('amount','>','refunded_amount');
	}

	/**
	 * Inactive cautionss
	 * @param   $query 
	 * @return  query builder
	 */
	public function scopeInactive($query)
	{
		return $query->where('amount','<=','refunded_amount');
	}

	/**
	 * Get balance attribute
	 * @return number
	 */
	public function getBalanceAttribute()
	{
		return $this->amount - $this->refunded_amount;
	}
}
