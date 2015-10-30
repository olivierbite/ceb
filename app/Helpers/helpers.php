<?php 
	/**
	 * Export to Excel
	 * 
	 * @param  $report 
	 * @param  string $name   
	 * @return file         
	 */
    function toExcel($report,$name='report'){
			$filename = $name .'.xls';
			header('Content-type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename='.$filename);
			 return $report;
	}

/**
 * Determine if a string is HTML
 */
function isImage($url) {
   $contentTypes = ['gif'	=>	'image/gif',
					'jpeg'	=>	array('image/jpeg', 'image/pjpeg'),
					'jpg'	=>	array('image/jpeg', 'image/pjpeg'),
					'jpe'	=>	array('image/jpeg', 'image/pjpeg'),
					'png'	=>	array('image/png',  'image/x-png'),
				];
  
   // Get unique header and exchange it with its key 
   $headers = array_flip(get_headers($url,1)['Content-Type']);
   
   // Put the the key back to its position and extract the header
   $header  = (new Illuminate\Support\Collection(array_flip($headers)))->first();

   foreach ($contentTypes as $type => $mime) {
   	 if (is_array($mime)) 
   	 {

   	 	foreach ($mime as $key => $value) 
   	 	{
   	 		 if (strpos($header, $value) !== false) 
   	 		 {
   	    	   return true;
   	         }

   	         continue;
   	 	}

   	 	continue;
   	 }


   	 if (strpos($header, $mime) !== false) 
	 {
   		return true;
 	 }
   }

   return false;
}
/**
 * Get simple range dates
 * @return  
 */
function get_simple_date_ranges()
{
		$today =  date('Y-m-d');
		$yesterday = date('Y-m-d', mktime(0,0,0,date("m"),date("d")-1,date("Y")));
		$six_days_ago = date('Y-m-d', mktime(0,0,0,date("m"),date("d")-6,date("Y")));
		$start_of_this_month = date('Y-m-d', mktime(0,0,0,date("m"),1,date("Y")));
		$end_of_this_month = date('Y-m-d',strtotime('-1 second',strtotime('+1 month',strtotime(date('m').'/01/'.date('Y').' 00:00:00'))));
		$start_of_last_month = date('Y-m-d', mktime(0,0,0,date("m")-1,1,date("Y")));
		$end_of_last_month = date('Y-m-d',strtotime('-1 second',strtotime('+1 month',strtotime((date('m') - 1).'/01/'.date('Y').' 00:00:00'))));
		$start_of_this_year =  date('Y-m-d', mktime(0,0,0,1,1,date("Y")));
		$end_of_this_year =  date('Y-m-d', mktime(0,0,0,12,31,date("Y")));
		$start_of_last_year =  date('Y-m-d', mktime(0,0,0,1,1,date("Y")-1));
		$end_of_last_year =  date('Y-m-d', mktime(0,0,0,12,31,date("Y")-1));
		$start_of_time =  date('Y-m-d', 0);
		return array(
			$today. '/' . $today 								=> trans('report.reports_today'),
			$yesterday. '/' . $yesterday						=> trans('report.reports_yesterday'),
			$six_days_ago. '/' . $today 						=> trans('report.reports_last_7'),
			$start_of_this_month . '/' . $end_of_this_month		=> trans('report.reports_this_month'),
			$start_of_last_month . '/' . $end_of_last_month		=> trans('report.reports_last_month'),
			$start_of_this_year . '/' . $end_of_this_year	 	=> trans('report.reports_this_year'),
			$start_of_last_year . '/' . $end_of_last_year		=> trans('report.reports_last_year'),
			$start_of_time . '/' . 	$today						=> trans('report.reports_all_time'),
		);
}

/**
 * Get months
 * @return months as array
 */
function get_months()
{
	$months = array();
	for($k=1;$k<=12;$k++)
	{
		$cur_month = mktime(0, 0, 0, $k, 1, 2000);
		$months[date("m", $cur_month)] = date("M",$cur_month);
	}
	
	return $months;
}

/**
 * Get days
 * @return  days as array
 */
function get_days()
{
	$days = array();
	
	for($k=1;$k<=31;$k++)
	{
		$cur_day = mktime(0, 0, 0, 1, $k, 2000);
		$days[date('d',$cur_day)] = date('j',$cur_day);
	}
	
	return $days;
}

/**
 * Get yeards 
 * @return years as array
 */
function get_years()
{
	$years = array();
	for($k=0;$k<10;$k++)
	{
		$years[date("Y")-$k] = date("Y")-$k;
	}
	
	return $years;
}
/**
 * Get random colors
 * @param   $how_many 
 * @return            
 */
function get_random_colors($how_many)
{
	$colors = array();
	
	for($k=0;$k<$how_many;$k++)
	{
		$colors[] = '#'.random_color();
	}
	
	return $colors;
}

/**
 * Get random color
 * @return  
 */
function random_color()
{
    mt_srand((double)microtime()*1000000);
    $c = '';
    while(strlen($c)<6){
        $c .= sprintf("%02X", mt_rand(0, 255));
    }
    return $c;
}