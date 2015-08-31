<?php

namespace Ceb\Models;

class Loan extends Model {
		/**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
	protected $dates = ['created_at', 'updated_at', 'letter_date'];
	
	// fillable
	protected $fillable = [
		'transactionid',
		'loan_contract',
		'adhersion_id',
		'movement_nature',
		'operation_type',
		'letter_date',
		'right_to_loan',
		'wished_amount',
		'loan_to_repay',
		'interests',
		'InteretsPU',
		'amount_received',
		'tranches_number',
		'monthly_fees',
		'cheque_number',
		'bank_id',
		'security_type',
		'cautionneur1',
		'cautionneur2',
		'average_refund',
		'amount_refounded',
		'comment',
		'special_loan_contract_number',
		'remaining_tranches',
		'special_loan_tranches',
		'special_loan_interests',
		'special_loan_amount_to_receive',
		'user_id',
	];
}
