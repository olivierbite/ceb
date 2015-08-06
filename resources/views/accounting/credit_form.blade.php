<div class="row credit-accounts">
<label>{{ trans('loan.credit_account') }}</label>
<div class="form-group" >
    <div class="col-xs-6">
    <label>{{ trans('accounting.debit_account') }}</label>
    </div>
    <div class="col-xs-4">
    <label>{{ trans('accounting.amount') }}</label>
    </div>
     <div class="col-xs-2">
     </div>
</div>
        @foreach($creditAccounts as $accountId => $amount)
            @include('accounting.credit')
        @endforeach
        @include('accounting.credit')
		<div class="btn btn-success add-button">
			+
		</div>
</div>