<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" >
	<input type="submit" 
	   class="col-xs-12 col-sm-12 col-md-12 col-lg-12 btn btn-lg btn-success"
	   value="{{ trans('contribution.complete_transaction') }}">

</div>
<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" >
	<a href="{{ route('contributions.cancel') }}"
	   class="col-xs-12 col-sm-12 col-md-12 col-lg-12 btn btn-lg btn-warning">
	   {{ trans('contribution.cancel_transaction') }}
	</a>
</div>
</div>
