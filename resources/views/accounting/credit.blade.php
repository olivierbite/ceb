<div class="form-group account-row" >
    <div class="col-xs-6">
    {!! Form::select('credit_accounts[]', $accounts,isset($accountId)?$accountId :null, ['class'=>'form-control account'])!!}
    </div>
    <div class="col-xs-4">
	{!! Form::input('numeric', 'credit_amounts[]', isset($amount)?$amount : 0 , ['class'=>'form-control accountAmount']) !!}
    </div>
     <div class="col-xs-2">
     <div class="btn btn-danger input-group-addon remove-button">
          -
      </div>
     </div>
</div>