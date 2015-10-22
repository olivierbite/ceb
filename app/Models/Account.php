<?php

namespace Ceb\Models;

use Illuminate\Support\Facades\DB;
class Account extends Model {


	/**
	 * Get posting / accounting transactions made for this model
	 * @return Ceb\Models\Posting 
	 */
	public function postings()
	{
		return $this->hasMany('\Ceb\Models\Posting');
	}

	/**
	 * Debit transactions
	 * @return Ceb\Models\Posting 
	 */
	public function debits()
	{
		return $this->postings()->with('journal')->where(DB::raw('LOWER(transaction_type)'),'debit');
	}

	/**
	 * Debit transactions
	 * @return Ceb\Models\Posting 
	 */
	public function credits()
	{
		return $this->postings()->with('journal')->where(DB::raw('LOWER(transaction_type)'),'credit');
	}
}
