      <div class="row debit-accounts">
      <label>{{ trans('loan.debit_account') }}</label>
      <div class="btn btn-success pull-right" style="margin-right: 5%;" id="add-debit-account">+</div>
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
                <div class='btn btn-danger'><i class='fa fa-times'></i></div> 
              </div>
            </div>
          </div>
      </div>
    </div>