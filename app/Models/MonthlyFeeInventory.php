<?php

namespace Ceb\Models;
use Ceb\Models\Model;
use Illuminate\Support\Facades\DB;

class MemberMontlyFeeLog extends Model {
	protected $table = 'MonthlyFeeInventory';


	/**
	 * Get history of the monthly fees
	 * @param  string $startDate start date in format of YYYY-MM-DD
	 * @param  string $endDate   end date in format of YYYY-MM-DD
	 * @return array|object
	 */
	public static function history($startDate,$endDate)
	{
		$query = "SELECT 
					  date(m.updated_at) dates,
				      m.type AS type,
					  CONCAT(first_name,' ',last_name) names,
				      i.name AS institution,
				      a.service,
				      m.amount
					FROM users a
						LEFT JOIN 
					     institutions AS i ON a.institution_id = i.id
						LEFT JOIN 
				         monthly_fee_inventory AS m ON a.adhersion_id = m.adhersion_id
				     WHERE m.amount IS NOT NULL AND date(m.updated_at) BETWEEN ? AND ?";


	    $results = DB::select($query, [$startDate,$endDate]);

	    return $results;

	}
}
