<table border="1">
	<thead>
		<tr>
			<th>{{ trans('account.date') }}</th>
			<th>{{ trans('account.wording') }}</th>
			<th>{{ trans('account.debit') }}</th>
			<th>{{ trans('account.credit') }}</th>
		</tr>
	</thead>
	<tbody>
	@forelse ($postings as $posting)
	<tr>
		<td>{!! $posting->created_at->format('d/M/Y') !!}</td>
		<td>{!! $posting->wording !!}</td>
		<td>{!! $posting->debit_amount !!}</td>
		<td>{!! $posting->credit_amount !!}</td>
	</tr>
	@empty
		{{-- empty expr --}}
	@endforelse
	<tr>
			<td colspan="2"><b>{{ trans('posting.wording') }}:</b> {!! $posting->wording !!}</td>
			<td>{!! $posting->where(DB::raw('LOWER(transaction_type)'),'debit')->sum('amount') !!}</td>
			<td>{!! $posting->where(DB::raw('LOWER(transaction_type)'),'credit')->sum('amount') !!}</td>
		</tr>
	</tbody>
</table>