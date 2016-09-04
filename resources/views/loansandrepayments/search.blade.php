<div class="container">
  <div class="row">
  <div class="col-md-12">
    <label>{{ $label }}</label>
  <div class="input-group">
    @if(is_null($cautionneur))
      <input type="text" class="form-control" placeholder="Type something here to start searching" name="{!! $fieldname !!}" id="srch-term">
      <div class="input-group-btn search-cautionneur" >
          <button class="btn btn-default" type="submit"><i class="fa fa-plus"></i></button>
      </div>
    @else
<div class="autocomplete-wrapper">
<p class="container item-content" >
    <img src="{{route('files.get', $cautionneur->photo)}}" align="left">
        <span class="adhersion_number">
          {{ $cautionneur->adhersion_id}}
       &nbsp; <a href="{{ route('loan.remove.cautionneur',$fieldname) }}" class="btn btn-warning">
          <i class="fa fa-remove"></i>
        </a>
        </span>
        <span class="names">
          {{ ucfirst(strtolower($cautionneur->first_name)) }} {{ ucfirst(strtolower($cautionneur->last_name))}}
          <br/>
          {{ trans('member.nid') }} : {{ $cautionneur->member_nid }}
        </span>
        {!! Form::hidden($fieldname, $cautionneur->adhersion_id,['class'=>'loan-input']) !!}
<p>
</div>
    @endif
</div>
  </div>
</div>
</div>