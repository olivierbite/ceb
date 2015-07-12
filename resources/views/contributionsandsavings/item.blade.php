<tr>
	<td>{!! $contribution->adhersion_id!!}</td>
	<td>{!! $contribution->first_name !!} {!! $contribution->last_name !!}</td>
	<td>{!! $contribution->institution !!}</td>
	<td>{!! $contribution->service !!}</td>
	<td>{!! $contribution->contribution_nid !!}</td>
	<td>{!! $contribution->district !!}</td>
	<td>{!! $contribution->created_at !!}</td>
	<td>
{!! Form::open(array('route' => array('contributions.destroy', $contribution->id), 'method' => 'delete')) !!}
		<a href="{!! route('contributions.show',$contribution->id) !!}" class="btn btn-success">
			<i class="fa fa-eye"></i>
		</a>
		<a href="{!! route('contributions.edit',$contribution->id) !!}" class="btn btn-primary">
			<i class="fa fa-edit"></i>
		</a>
        <button type="submit" class="btn btn-danger "onclick="return confirm('{!! trans('general.are_you_sure_you_want_to_delete_this_item') !!}')">
        		<i class="fa fa-remove"></i>
        </button>
    {!! Form::close() !!}

		</td>
</tr>