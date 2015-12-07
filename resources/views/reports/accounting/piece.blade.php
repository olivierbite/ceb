<table class="pure-table pure-table-bordered">
<caption> {{ trans('reports.piece') }} </caption>
	<thead>
		<tr>
			<th>{{ trans('account.account_number') }}</th>
			<th>{{ trans('account.titled') }}</th>
			<th>{{ trans('account.debit') }}</th>
			<th>{{ trans('account.credit') }}</th>
		</tr>
	</thead>
	<tbody>
	@forelse ($postings as $posting)
		 @include('reports.accounting.item', ['posting'=>$posting])
	@empty
		{{-- empty expr --}}
	@endforelse
	<tr>
			<td colspan="2"><b>{{ trans('posting.wording') }}:</b> {!! $posting->wording !!}</td>
			<td>
			    {!! $posting->where(DB::raw('LOWER(transaction_type)'),'debit')->betweenDates(Request::segment(4),Request::segment(5))->sum('amount') !!}
			 </td>
			<td>{!! $posting->where(DB::raw('LOWER(transaction_type)'),'credit')->betweenDates(Request::segment(4),Request::segment(5))->sum('amount') !!}</td>
		</tr>
	</tbody>
</table>