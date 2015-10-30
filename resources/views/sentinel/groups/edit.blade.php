@extends(config('sentinel.layout'))

<!-- Web site Title -->
@section('title')
@parent
Edit Group
@stop

<!--- Content -->
@section('content')
<form method="POST" action="{!! route('sentinel.groups.update', $group->hash) !!}" accept-charset="UTF-8">
  
        <div class="small-6 large-centered columns">
            <h3>Edit Group</h3>
              <div class="row">
                    <div class="col-md-2">
                    <label for="right-label" class="right inline">{{ trans('group.name') }}</label>
                    </div>
                <div class="col-md-4 {!! ($errors->has('name')) ? 'error' : '' !!}">
                    <input placeholder="Name" name="name" value="{!! Input::old('name') ? Input::old('name') : $group->name !!}" type="text" class="form-control">
                    {!! ($errors->has('name') ? $errors->first('name', '<small class="error">:message</small>') : '') !!}
                </div>
                <input class="btn btn-lg btn-success col-md-12" value="Save Changes" type="submit">
              </div>
                @include('sentinel.groups.permissions')
               
                <div class="row">
                  <div class="col-md-12">
                                <input name="id" value="{!! $group->hash !!}" type="hidden">
                                <input name="_method" value="PUT" type="hidden">
                                <input name="_token" value="{!! csrf_token() !!}" type="hidden">
                                <input class="btn btn-lg btn-success col-md-12" value="Save Changes" type="submit">
                </div>
            </div>
        </div>
    </div>
{!! Form::close() !!}
</div>
</div>
@stop