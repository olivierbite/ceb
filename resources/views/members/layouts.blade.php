 <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" >
 @include('members.form')
</div>
<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" >
<div class="row">
	@include('members.attornies',['member'=>$member])

	<button class="btn btn-success">{{ trans('member.transaction') }}</button>
</div>
<div class="row">
@include('members.contracts')
</div>
</div>

<script src="{{Url()}}/assets/dist/js/datepickr.js" type="text/javascript"></script>
<script src="{{Url()}}/assets/dist/js/date.js" type="text/javascript"></script>