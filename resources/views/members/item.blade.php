<tr>
	<td>{!! $customer->email!!}</td>
	<td>{!! $customer->description !!}</td>
	<td>{!! $customer->livemode !!}</td>
	<td>
{!! Form::open(array('route' => array('customers.destroy', $customer->id), 'method' => 'delete')) !!}

		<a href="{!! route('customers.edit',$customer->id) !!}" onclick="modal(this,28)" class="ui left button"><i class="edit blue icon"></i></a>

        <button type="submit" class="ui button "onclick="return confirm('{!! trans('general.are_you_sure_you_want_to_delete_this_item') !!}')"><i class="cancel red icon"></i></button>
    {!! Form::close() !!}

		</td>
</tr>