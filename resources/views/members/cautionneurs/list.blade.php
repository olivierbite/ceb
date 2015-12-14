<table class="table table-bordered" style="background-color: #fff">
  	 <thead>
  	 <tr>
  	 	<th>
  	 		{!! $title !!}
  	 	</th>
  	 </tr>
 	<tr>
      <th>{{ trans('member.adhersion_number') }}</th>
  	 		<th>{{ trans('member.names') }}</th>
  	 		<th>{{ trans('member.institution') }}</th>
  	 		<th>{{ trans('member.service') }}</th>
	        <th>{{ trans('member.amount') }}</th>
	        <th>{{ trans('member.refunded_amount') }}</th>
	        <th>{{ trans('member.balance') }}</th>
  	 </tr>
   	 </thead>
 <tbody>
  @forelse ($cautions as $caution)
    @include('members.cautionneurs.item',compact('caution','type'))
  @empty
    @include('members.no-items')
  @endforelse
 </tbody>
</table>