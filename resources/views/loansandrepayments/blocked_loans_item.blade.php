<?php $member = $loan->member; ?>
<tr>
	<td>{{ $member->first_name.' '.$member->last_name }}</td>
	<td>{{ $member->institution->name }} </td>
	<td>{{ $member->adhersion_id }}  </td>
	<td>{{ $member->Loan_balance }} </td>
	<td>{{ $member->right_to_loan }} </td>
	<td>{{ $loan->wished_amount }} </td>
	<td>{{ $loan->rate }}</td>
	<td>{{ $loan->tranches_number }}</td>
	<td>{{ $loan->monthly_fees }} </td>
	<td>{{ $loan->loan_to_repay }}</td>
	<td>{{ $loan->interests }}</td>
	<td>
		<a href="{!! route('loan.unblock.form',['loanId'=> $loan->id]) !!}" class="btn btn-success popdown">
			<i class="fa fa-unlock-alt"></i> {{ trans('loan.unblock') }}
		</a>
	</td>
</tr>
