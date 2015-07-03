<tr>
	<td>{!! $member->adhersion_id!!}</td>
	<td>{!! $member->first_name !!} {!! $member->last_name !!}</td>
	<td>{!! $member->institution !!}</td>
	<td>{!! $member->service !!}</td>
	<td>{!! $member->member_nid !!}</td>
	<td>{!! $member->district !!}</td>
	<td>{!! $member->created_at !!}</td>
	<td>
{!! Form::open(array('route' => array('members.destroy', $member->id), 'method' => 'delete')) !!}
		<a href="{!! route('members.show',$member->id) !!}" class="btn btn-success">
			<i class="fa fa-eye"></i>
		</a>
		<a href="{!! route('members.edit',$member->id) !!}" class="btn btn-primary">
			<i class="fa fa-edit"></i>
		</a>
        <button type="submit" class="btn btn-danger "onclick="return confirm('{!! trans('general.are_you_sure_you_want_to_delete_this_item') !!}')">
        		<i class="fa fa-remove"></i>
        </button>
    {!! Form::close() !!}

		</td>
</tr>