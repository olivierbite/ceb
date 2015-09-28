{{-- {!! Form::open(array('route' => array('refunds.update', $member['id']), 'method' => 'PUT')) !!} --}}
<tr>
	<td>{!! Form::checkbox('memberIds[]', $member->id, true) !!}</td>
	<td>{!! $member->adhersion_id !!}</td>
	<td>{!! $member->first_name !!} {!! $member['last_name'] !!}</td>
	<td>{!! $member->institution?$member->institution->name:null !!}</td>
	<td>{!! Form::text('monthly_fee',  $member->loanMonthlyFees() , ['class'=>'form-control','size'=>'2','disabled'])!!}</td>
	<td>
	<span>
	 	<i class="ion ion-ios-cart-outline"></i>
	</span>
	</td>
</tr>
{{-- {!! Form::close() !!} --}}
