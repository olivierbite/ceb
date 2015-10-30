<?php $defaultPermissions = config('sentinel.default_permissions', []); ?>
<?php $permissionGroup = null;  ?>
<div class="row">
@foreach ($defaultPermissions as $permission)
{{-- is this a new permission group then starts it's grid --}}
   @if ($permissionGroup != explode('.', $permission)[0] )
      {{-- If this the permission is not null , then I need to close previous group --}}
       @if (!is_null($permissionGroup))
                </ul>
              </div>
            </div>
          </div>
       @endif

      {{-- Open new group grid  --}}
      <div class="col-md-4">
          <div class="box box-warning">
              <div class="box-header with-border"> 
               <h4 "box-title">{!! $permissionGroup = explode('.', $permission)[0] !!}</h4>
              </div>
            <div class="box-body">
            <ul>
            @endif
            <li>
              <input name="permissions[{!! $permission !!}]" value="1" type="checkbox" {!! (isset($permissions[$permission]) ? 'checked' : '') !!}>
              <?php $permissionLabel =  explode('.', $permission); ?>
              @if (count($permissionLabel) > 0)
                @foreach ($permissionLabel as $key => $value)

                {{-- if the permission doesn't have sub keys then display the key and continue --}}
                @if ($key == 0  && count($permissionLabel) > 1)
                
                @else
                  {!! $value !!}
                @endif    

                @endforeach 
              @endif
            </li>      
      @endforeach
      </ul>
    </div>
  </div>
</div>