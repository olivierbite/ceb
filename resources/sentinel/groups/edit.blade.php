@extends(config('sentinel.layout'))

<!-- Web site Title -->
@section('title')
@parent
Edit Group
@stop

<!--- Content -->
@section('content')
<section class="content">
<div class="box">
<form method="POST" action="{!! route('sentinel.groups.update', $group->hash) !!}" accept-charset="UTF-8">
  
        <div class="small-6 large-centered columns">
            <h3>Edit Group</h3>

            
                <div class="small-2 columns">
                    <label for="right-label" class="right inline">Name</label>
                </div>
                <div class="small-10 columns {!! ($errors->has('name')) ? 'error' : '' !!}">
                    <input placeholder="Name" name="name" value="{!! Input::old('name') ? Input::old('name') : $group->name !!}" type="text">
                    {!! ($errors->has('name') ? $errors->first('name', '<small class="error">:message</small>') : '') !!}
                </div>
            
    
           
                {!! Form::label('edit_memberships', 'Permissions') !!}  
                <?php $defaultPermissions = config('sentinel.default_permissions', []); ?>
                @foreach ($defaultPermissions as $permission)

                    <div class="small-10 small-offset-2 columns">
                       <input name="permissions[{!! $permission !!}]" value="1" type="checkbox" {!! (isset($permissions[$permission]) ? 'checked' : '') !!}>
                       {!! ucwords(str_replace('.', ' ', $permission)) !!}
                    </div>
                @endforeach
            

            
                <div class="small-10 small-offset-2 columns">
                    <input name="id" value="{!! $group->hash !!}" type="hidden">
                    <input name="_method" value="PUT" type="hidden">
                    <input name="_token" value="{!! csrf_token() !!}" type="hidden">
                    <input class="button" value="Save Changes" type="submit">
                </div>
            

        </div>
    </div>
{!! Form::close() !!}
</div>
</div>
@stop