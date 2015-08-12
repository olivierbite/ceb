<?php

namespace Ceb\Models;
class Refund extends Model {

	protected $fillable = [
		'adhersion_id',
		'contract_number',
		'month',
		'amount',
		'tranches_number',
		'transaction_id',
		'member_id',
		'user_id'];
}
