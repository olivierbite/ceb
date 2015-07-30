<label>{{ $label }}</label>
  <div class="input-group">
    @if(is_null($cautionneur))
      <input type="text" class="form-control" placeholder="Search" name="{!! $fieldname !!}" id="srch-term">
      <div class="input-group-btn search-cautionneur" >
          <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
      </div>
    @else
<div class="autocomplete-wrapper">
<p class="item-content" >
    <img src="{{route('files.get', $cautionneur->photo)}}" align="left">
        <span class="adhersion_number">
        			{{ $cautionneur->adhersion_id}}
        <a href="{{ route('loan.remove.cautionneur',$fieldname) }}" class="btn btn-danger">
        	<i class="fa fa-remove"></i>
        </a>
        </span>
        <span class="names">
        	{{ $cautionneur->first_name}} {{ $cautionneur->last_name}}
        	<br/>
        	{{ trans('member.nid') }} : {{ $cautionneur->member_nid }}
        </span>
<p>
</div>
    @endif
</div>