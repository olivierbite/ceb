<?php $member = $loan->member; ?>
<tr>
	<td>{!! $number !!}</td>
	<td>{!! $member->names !!}</td>
	<td>{!! $member->institution_name !!}</td>
	<td>{!! $member->adhersion_id !!}</td>
	<td>{!! $member->total_contribution !!}</td>
	<td>{!! $member->loan_balance !!}</td>
	<td>Solde</td>
	<td>{!! $member->monthly_fee !!}</td>
	<td>{!! $loan->right_to_loan !!}</td>
	<td>{!! $loan->wished_amount !!}</td>
	<td>{!! $loan->rate !!}</td>
	<td>{!! $loan->tranches_number !!}</td>
	<td>{!! $loan->monthly_fees !!}</td>
	<td>{!! $loan->loan_to_repay !!}</td>
	<td>{!! $member->loan_balance + $loan->loan_to_repay !!}</td>
	<td>Facteur</td>
	<td>{!! $loan->interests !!}</td>
	<td>{!! $loan->urgent_loan_interests !!}</td>
	<td>{!! $loan->amount_received !!}</td>
	<td>{!! $loan->operation_type !!}</td>
</tr>
