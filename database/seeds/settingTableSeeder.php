<?php

use Illuminate\Database\Seeder;

class settingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     if (DB::table('settings')->count()>0) {
    		return true;
    	}
	 
	 $settings = [
	  0 => [
	  	    'key'	=> 'loan.member.minimum.months',
	  	    'value' => 6,
	  	    'type'  => 'numeric',
	  	   ],
	  1 => [
	  	    'key'=> 'loan.give.ordinary.loan.2',
	  	    'value' => false,
	  	    'type'  => 'boolean',
	  	   ],
	  2 => [
	  	    'key'=> 'loan.maximum.cautionneurs',
	  	    'value' => 2,
	  	    'type'  => 'numeric',
	  	   ],
	  3 => [
	  	    'key'=> 'loan.maximum.installments',
	  	    'value' => 72,
	  	    'type'  => 'numeric',
	  	   ],
	  4 => [
	  	    'key'=> 'loan.wished.amount',
	  	    'value' => 2.5,
	  	    'type'  => 'numeric',
	  	   ],
	 ];

     DB::table('settings')->insert($settings);
    }
}
