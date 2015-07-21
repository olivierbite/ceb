<?php

namespace Ceb\Models;

use Illuminate\Database\Eloquent\Model;

class Posting extends Model {

	protected $fillable = [
		'transactionid',
		'account_id',
		'journal_id',
		'asset_type',
		'amount',
		'user_id',
		'account_period',
	];
}
