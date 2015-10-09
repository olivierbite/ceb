<tr>
 	<td>{{ $contribution->created_at }}</td>
 	<td>{{ $contribution->transaction_type }}</td>
	<td>{{ $contribution->transaction_reason }}</td>
	<td>{{ $contribution->wording }}</td>
	<td>{{ (strtolower($contribution->transaction_type) == 'saving')?  $contribution->amount :  0 }}</td>
	<td>{{ (strtolower($contribution->transaction_type) == 'withdrawal')? $contribution->amount  : 0 }}</td>
</tr>