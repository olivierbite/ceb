@if (strtolower($type) == 'me')
	<?php $member = $caution->cauttionneur; ?>
@else
	<?php $member = $caution->member; ?>
@endif

<tr>
 	<td>{{ $member->adhersion_id }}</td>
 	<td>{{ $member->first_name }} {{ $member->last_name }}</td>
	<td>{{ $member->service }}</td>
	<td>{{ $member->total_contribution }}</td>
	<td>{{ $caution->amount }}</td>
	<td>{{ $caution->refunded_amount }}</td>
	<td>{{ $caution->balance }}</td>
	<td>{{ $caution->transaction_id }}</td>
	<td>{{ $caution->letter_date }}</td>
	<td>{{ $caution->Status }}</td>
</tr>