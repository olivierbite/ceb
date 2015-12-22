<tr>
 	<td>{{ $contribution->created_at->format('Y-m-d') }}</td>
 	<td>{{ $contribution->transaction_type }}</td>
	<td>{{ $contribution->transaction_reason }}</td>
	<td>{{ $contribution->wording }}</td>
	<td>{{ (strtolower($contribution->transaction_type) == 'saving')?  number_format($contribution->amount) :  0 }}</td>
	<td>{{ (strtolower($contribution->transaction_type) == 'withdrawal')? number_format($contribution->amount)  : 0 }}</td>
</tr>