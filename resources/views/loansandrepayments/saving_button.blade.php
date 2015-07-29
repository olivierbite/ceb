<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" >
	<a href="{{ route('loan.complete') }}"
	   class="col-xs-12 col-sm-12 col-md-12 col-lg-12 btn btn-lg btn-success">
	  {{ trans('loans.saving') }}
	</a>
</div>
<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" >
	<a href="{{ route('loan.cancel') }}"
	   class="col-xs-12 col-sm-12 col-md-12 col-lg-12 btn btn-lg btn-danger">
	  {{ trans('loans.cancel') }}
	</a>
</div>

</div>
