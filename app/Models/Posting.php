<?php

namespace Ceb\Models;

class Posting extends Model {

	protected $fillable = [
		'transactionid',
		'account_id',
		'journal_id',
		'asset_type',
		'amount',
		'user_id',
		'account_period',
		'transaction_type',
		'wording',
		'cheque_number',
		'bank',
	];

	/**
	 * Relationship with journal
	 * @return Ceb\Models\Journal
	 */
	public function journal()
	{
		return $this->belongsTo('\Ceb\Models\Journal');
	}
}
