<?php

namespace Ceb\Models;
use Ceb\Models\Model;

class LoanRate extends Model {
	
	protected  $table = 'loan_rates';

	/**
	 * Rate for give months
	 * @param   $query 
	 * @param   $start 
	 * @param   $end   
	 * @return         
	 */
    public function scopeRate($query,$monthNumber)
    {
    	return $query->where('start_month','>=',$monthNumber)->orWhere('end_month','<=',$monthNumber)->first()->rate;
    }
}
