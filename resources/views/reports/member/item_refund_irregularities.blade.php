<tr>
 	<td>{{ $member->adhersion_id }}</td>
 	<td>{{ $member->first_name }} {{ $member->last_name }}</td>
	<td>{{ $member->service }}</td>
	<td>{{ $member->contributed_amount }}</td>
	<td>{{ $loanBalance = $member->loansAmount - $member->refundedAmount }}</td>
	<td>{{ $member->contributed_amount - $loanBalance }}</td>
	<td>{{ date('Y-m-d',strtotime($member->last_date)) }}</td>
	<td>{{ $member->comment }}</td>
	<td>{{ round($loanBalance/$member->monthly_fees) }}</td>
	<td> n/a </td>
	<td> n/a </td>
</tr>