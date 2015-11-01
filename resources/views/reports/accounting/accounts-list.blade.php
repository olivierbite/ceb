<table border="1">
	<thead>
		<tr>
			<th>{{ trans('account.account_number') }}</th>
			<th>{{ trans('account.titled') }}</th>
			<th>{{ trans('account.account_nature') }}</th>
		</tr>
	</thead>
	<tbody>
	@forelse ($accounts as $account)
	<tr>
	 <td>{!! $account->account_number !!}</td>
	 <td>{!! $account->entitled !!}</td>
	 <td>{!! $account->account_nature !!}</td>
	</tr>
	@empty
		{{-- empty expr --}}
	@endforelse

	</tbody>
</table>