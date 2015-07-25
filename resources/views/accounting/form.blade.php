<div class="box-body">
<div class="box-header with-border">
  <h3 class="box-title">{{ trans('accounting.accounting') }}</h3>
 </div>
	<div class="row">
	    <div class="col-md-6">
	    	@include('accounting.debit_form')
	    </div>
	    <div class="col-md-6">
	    	@include('accounting.credit_form')
	    </div>
	</div>
	</div>