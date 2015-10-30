{{-- {!! Form::open(array('route' => array('refunds.update', $member['id']), 'method' => 'PUT')) !!} --}}
<tr>
	<td>{!! Form::checkbox('memberIds[]', $member->id, true) !!}</td>
	<td>{!! $member->adhersion_id !!}</td>
	<td>
		<img class="direct-chat-img" src="{{route('files.get', $member->photo)}}" align="left">
		<strong>{!! $member->first_name !!} {!! $member->last_name !!}</strong> <br/>
		<small><strong>{{trans('member.nid')}}:</strong></small><small>{!! $member->member_nid !!}</small>
	 </td>
	<td>{!! $member->institution?$member->institution->name:null !!}</td>
	<td>{!! Form::text('monthly_fee',  $member->loanMonthlyFees() , ['class'=>'form-control','size'=>'2','disabled'])!!}</td>
	<td>
	<span>
	 	<i class="ion ion-ios-cart-outline"></i>
	</span>
	</td>
</tr>
{{-- {!! Form::close() !!} --}}
