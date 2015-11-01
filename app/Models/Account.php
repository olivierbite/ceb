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
		return $this->postings()->where(DB::raw('LOWER(transaction_type)'),'debit');
	}

	/**
	 * Debit transactions
	 * @return Ceb\Models\Posting 
	 */
	public function credits()
	{
		return $this->postings()->where(DB::raw('LOWER(transaction_type)'),'credit');
	}

	/**
	 * Get debit amount sum  for this account
	 * @return numeric
	 */
	public function getDebitAmountAttribute()
	{
		return $this->debits()->sum('amount');
	}

	/**
	 * Get credit amount sum  for this account
	 * @return numeric
	 */
	public function getCreditAmountAttribute()
	{
		return $this->credits()->sum('amount');
	}
}
