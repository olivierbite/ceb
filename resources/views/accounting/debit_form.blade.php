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
<div class="form-group account-row" >
    <div class="col-xs-6">
       {!! Form::select('debit_accounts[]', $accounts,null, ['class'=>'form-control'])!!}
    </div>
    <div class="col-xs-4">
    	{!! Form::input('numeric', 'debit_amount', '', ['class'=>'form-control']) !!}
    </div>
     <div class="col-xs-2">
          <div class="btn btn-danger input-group-addon remove-button">
          -
      </div>
      </div>
</div>
		<div class="btn btn-success add-button">
			+
		</div>
</div>