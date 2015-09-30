<div class="box-header with-border">
  <h3 class="box-title">{{ trans('accounting.accounting') }}</h3>
 </div>
<div class="row">
    <div class="col-md-6">
      <div class="row debit-accounts">
      <label>{{ trans('loan.debit_account') }}</label>
      <div class="btn btn-success pull-right" id="add-debit-account">+</div>
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
      <div class="form-group" >
          <div id="debit-accounts-container">
            <div class="form-group account-row" >
              <div class="col-xs-6">
                {!! Form::select('debit_accounts[]', $accounts,isset($accountId)?$accountId :null, ['class'=>'form-control account'])!!}
              </div>
              <div class="col-xs-4">
                {!! Form::input('numeric', 'debit_amounts[]', isset($amount)?$amount : 0 , ['class'=>'form-control accountAmount']) !!}
              </div>
              <div class="col-xs-2">
                <button class='btn btn-danger'><i class='fa fa-times'></i></button> 
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
    <!-- START OF CREDIT ACCOUNT -->
    <div class="col-md-6">
      <label>{{ trans('loan.credit_account') }} </label>
      <div class="btn btn-success pull-right" id="add-credit-account">+</div>
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
                <button class='btn btn-danger'><i class='fa fa-times'></i></button> 
              </div>
            </div>
          </div>       
      </div>
   
    </div>
     <!-- END OF CREDIT ACCOUNT -->
</div>