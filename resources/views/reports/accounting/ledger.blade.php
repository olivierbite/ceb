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
			<td>{!! $posting->betweenDates(Request::segment(4),Request::segment(5))->debits()->sum('amount') !!}</td>
			<td>{!! $posting->betweenDates(Request::segment(4),Request::segment(5))->credits()->sum('amount') !!}</td>
		</tr>
	</tbody>
</table>