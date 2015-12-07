@if (!$postings->isEmpty())
<table class="pure-table pure-table-bordered">
<caption> {{ trans('reports.ledger') }} </caption>
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
		<td>{!! $posting->created_at->format('Y-m-d') !!}</td>
		<td>{!! $posting->wording !!}</td>
		<td>{!! $posting->debit_amount !!}</td>
		<td>{!! $posting->credit_amount !!}</td>
	</tr>
	@empty
		{{-- empty expr --}}
	@endforelse
	<tr>
			<td colspan="2"><b>{{ trans('posting.wording') }}:</b> {!! $postings->first()->wording !!}</td>
			<td>{!! $postings->sum('amount') !!}</td>
			<td>{!! $postings->sum('amount') !!}</td>
		</tr>
	</tbody>
</table>
@endif