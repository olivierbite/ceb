@include('partials.landscapecss')

<table class="pure-table pure-table-bordered">
<caption> {{ trans('reports.monthly_fees_inventory') }}
{{ trans('general.between') }} 
      {!! date('d/M/Y',strtotime(request()->segment(4))) !!} 
    {{ trans('general.and') }} 
      {!! date('d/M/Y',strtotime(request()->segment(5))) !!}


 </caption>
  	 <thead>
  	 	<tr>
	  	 	<th>{{ trans('general.date') }}</th>
			<th>{{ trans('loan.operation_type') }}</th>
			<th>{{ trans('member.names') }}</th>
			<th>{{ trans('member.institution') }}</th>
	        <th>{{ trans('member.service') }}</th>
	        <th>{{ trans('member.monthly_fees') }}</th>
	  	</tr>
   	 </thead>
 <tbody>
  	@foreach ($history as $item)
  	 <tr>
  	 	<td>{!! $item->dates !!}</td>
  	 	<td>{!! $item->type !!}</td>
  	 	<td>{!! $item->names !!}</td>
  	 	<td>{!! $item->institution !!}</td>
  	 	<td>{!! $item->service !!}</td>
  	 	<td>{!! $item->amount !!}</td>
  	 </tr>
  	@endforeach
 </tbody>
</table>
