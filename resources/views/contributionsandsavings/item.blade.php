<tr>
	<td>{!! Form::checkbox('memberIds[]', $member->id, true) !!}</td>
	<td>{!! $member->adhersion_id!!}</td>
	<td>{!! $member->first_name !!} {!! $member->last_name !!}</td>
	<td>{!! $member->institution?$member->institution->name:null !!}</td>
	<td>{!! Form::text('monthly_fees[]',  $member->monthly_fee , ['class'=>'form-control','size'=>'2'])!!}</td>
	<td>
	{!! Form::open(array('route' => array('contributions.destroy', $member->id), 'method' => 'delete')) !!}
		<a href="{!! route('contributions.edit',$member->id) !!}" class="btn btn-primary">
			<i class="fa fa-edit"></i>
		</a>
    {!! Form::close() !!}

		</td>
</tr>