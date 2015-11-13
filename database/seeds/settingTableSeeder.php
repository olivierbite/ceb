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
      5 => [
	  	    'key'=> 'loan.allow.member.with.negative.right.to.loan',
	  	    'value' => 1,
	  	    'type'  => 'boolean',
	  	   ],
	  6 => [
	  	    'key'=> 'loan.administration.fee',
	  	    'value' => 2,
	  	    'type'  => 'percentage',
	  	   ],
	  7 => [
	  	    'key'=> 'special_loan.amount',
	  	    'value' => 100000,
	  	    'type'  => 'numeric',
	  	   ],
	  8 => [
	  	    'key'=> 'social_loan.amount',
	  	    'value' => 500000,
	  	    'type'  => 'numeric',
	  	   ],
	  9 => [
	  	    'key'=> 'emergency_loan.amount',
	  	    'value' => 210000,
	  	    'type'  => 'numeric',
	  	   ],
	 ];

	 DB::table('settings')->truncate();

     DB::table('settings')->insert($settings);
    }
}
