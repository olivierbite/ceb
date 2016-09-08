<tr>
 	<td>{{ $member->adhersion_id }}</td>
 	<td>{{ $member->first_name }} {{ $member->last_name }}</td>
	<td>{{ $member->service }}</td>
	<td>{{ number_format((int) $member->contributed_amount) }}</td>
	<td>{{ number_format((int) $loanBalance = $member->loansAmount - $member->refundedAmount) }}</td>
	<td>{{ number_format($member->contributed_amount - $loanBalance) }}</td>
	<td>{{ date('Y-m-d',strtotime($member->last_date)) }}</td>
	<td>{{ $member->comment }}</td>
	<td>{{ (!is_null($member->monthly_fees)&&$member->monthly_fees>0)?  number_format((int)$loanBalance/$member->monthly_fees): $loanBalance}}</td>
	<td> n/a </td>
	<td> n/a </td>
</tr>