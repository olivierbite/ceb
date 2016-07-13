<table class="pure-table pure-table-bordered">
<caption>	
		{{ trans('reports.loan_payback') }}  
		{{ trans('general.between') }} 
			{!! date('d/M/Y',strtotime(request()->segment(3))) !!} 
		{{ trans('general.and') }} 
			{!! date('d/M/Y',strtotime(request()->segment(4))) !!}
</caption>
	<thead>
		<tr>
			<th>{{ trans('member.names') }}</th>
			<th>{{ trans('member.adhersion_id') }}</th>
			<th>{{ trans('member.loan') }}</th>
			<th>{{ trans('member.refund') }}</th>
			<th>{{ trans('member.balance') }}</th>
		</tr>
	</thead>
	<tbody>
		@forelse ($loans as $item)
			<tr>
				<td>{!! $item->names !!}</td>
				<td>{!! $item->adhersion_id !!}</td>
				<td>{!! $item->loan !!}</td>
				<td>{!! $item->refund !!}</td>
				<td>{!! $item->balance !!}</td>
		</tr>
		@empty
			nothing to show here
		@endforelse
	</tbody>
</table>	
