<?php $account = $posting->account; ?>
<tr>
	<td>{!! $account->account_number !!}</td>
	<td>{!! $account->account_number !!}</td>
	<td>{!! (strtolower($posting->transaction_type) == 'debit') ? $posting->amount : null !!}</td>
	<td>{!! (strtolower($posting->transaction_type) == 'credit') ? $posting->amount : null !!}</td>
</tr>