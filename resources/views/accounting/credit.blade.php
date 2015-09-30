<div class="row credit-accounts">
<label>{{ trans('loan.credit_account') }} </label>
      <div class="btn btn-success pull-right" style="margin-right: 5%;" id="add-credit-account">+</div>
      <div class="form-group" >
          <div class="col-xs-6">
          <label>{{ trans('accounting.creditt_account') }}</label>
          </div>
          <div class="col-xs-4">
          <label>{{ trans('accounting.amount') }}</label>
          </div>
           <div class="col-xs-2">
           </div>
      </div>
       <div class="form-group" >
          <div id="credit-accounts-container">
            <div class="form-group account-row" >
              <div class="col-xs-6">
                {!! Form::select('credit_accounts[]', $accounts,isset($accountId)?$accountId :null, ['class'=>'form-control account'])!!}
              </div>
              <div class="col-xs-4">
                {!! Form::input('numeric', 'credit_amounts[]', isset($amount)?$amount : 0 , ['class'=>'form-control accountAmount']) !!}
              </div>
              <div class="col-xs-2">
                <div class='btn btn-danger'><i class='fa fa-times'></i></div> 
              </div>
            </div>
          </div>       
      </div>
</div>