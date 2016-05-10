<?php $member = $loan->member; ?>
<tr>
	<td>{{ $member->first_name.' '.$member->last_name }}</td>
	<td>{{ $member->institution->name }} </td>
	<td>{{ $member->adhersion_id }}  </td>
	<td>{{ $member->loan_balance }} </td>
	<td>{{ $loan->right_to_loan }} </td>
	<td>{{ $loan->wished_amount }} </td>
	<td>{{ number_format($loan->amount_received) }}</td>
	<td>{{ $loan->rate }}</td>
	<td>{{ $loan->tranches_number }}</td>
	<td>{{ $loan->calculated_monthly_fee }} </td>
	<td>{{ $loan->loan_to_repay }}</td>
	<td>{{ $loan->interests }}</td>
	<td>{{ $loan->is_regulation==1?trans('general.yes'):trans('general.no') }}</td>
	<td>
		<a href="{!! route('loan.process',['loanId'=> $loan->id,'status'=>'approved']) !!}" class="btn btn-success">
			<i class="fa fa-check"></i>
		</a>
		<a href="{!! route('loan.process',['loanId'=> $loan->id,'status'=>'rejected']) !!}" class="btn btn-danger">
			<i class="fa fa-close"></i>
		</a>
	</td>
</tr>
