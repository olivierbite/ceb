<?php

namespace Ceb\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Ceb\Traits\LogsActivity;
use Spatie\Activitylog\LogsActivityInterface;

class Model extends Eloquent implements LogsActivityInterface {
	use LogsActivity;

	/**
	 * Get contribution between two dates
	 * 
	 * @param  eloquent $query 
	 * @param  string   $date1 start date
	 * @param  string   $date2 end date
	 * @return $this   
	 */
	public function scopeBetweenDates($query,$date1,$date2)
    {
    	$date1 = date('Y-m-d',strtotime($date1)).' 00:00:00';
    	$date2 = date('Y-m-d',strtotime($date2)).' 23:59:59';

        return $query->whereBetween('created_at', [$date1, $date2]);
    }
}