<div class="row debit-accounts">
<label>{{ trans('loan.debit_account') }}</label>
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
        @foreach($debitAccounts as $accountId => $amount)
            @include('accounting.debit')
        @endforeach
        @include('accounting.debit')

		<div class="btn btn-success add-button">
			+
		</div>
</div>