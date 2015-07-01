@extends(config('sentinel.layout'))

{{-- Web site Title --}}
@section('title')
Current Users 
@stop
@section('description')
Click here for <a href="{!! route('sentinel.groups.index') !!}" class="btn btn-success">User groups</a>
@stop

{{-- Content --}}
@section('content')

<div class="box">
                <div class="box-header">
                  <a class='btn btn-primary' href="{{ route('sentinel.users.create') }}">Create User</a>
                  <div class="box-tools">
                    <div class="input-group">
                      <input type="text" name="table_search" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search">
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-success"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
<table class="table table-striped">
		<thead>
			<th>User</th>
			<th>Status</th>
			<th>Options</th>
		</thead>
		<tbody>
			@foreach ($users as $user)
				<tr>
					<td><a href="{{ route('sentinel.users.show', array($user->hash)) }}">{{ $user->email }}</a></td>
					<td>{{ $user->status }} </td>
					<td>
						 <button class="btn btn-default" type="button" onClick="location.href='{{ action('\\Sentinel\Controllers\UserController@edit', array($user->hash)) }}'">Edit</button>
                        @if ($user->status != 'Suspended')
                            <button class="btn btn-default" type="button" onClick="location.href='{{ action('\\Sentinel\Controllers\UserController@suspend', array($user->hash)) }}'">Suspend</button>
                        @else
                            <button class="btn btn-default" type="button" onClick="location.href='{{ action('\\Sentinel\Controllers\UserController@unsuspend', array($user->hash)) }}'">Un-Suspend</button>
                        @endif
                        @if ($user->status != 'Banned')
                            <button class="btn btn-default" type="button" onClick="location.href='{{ action('\\Sentinel\Controllers\UserController@ban', array($user->hash)) }}'">Ban</button>
                        @else
                            <button class="btn btn-default" type="button" onClick="location.href='{{ action('\\Sentinel\Controllers\UserController@unban', array($user->hash)) }}'">Un-Ban</button>
                        @endif
                        <button class="btn btn-default action_confirm" href="{{ action('\\Sentinel\Controllers\UserController@destroy', array($user->hash)) }}" data-token="{{ Session::getToken() }}" data-method="delete">Delete</button>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	 </div><!-- /.box-body -->
              </div>
@stop
