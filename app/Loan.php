<?php

namespace Ceb;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
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
			'user_id'
	];
}
