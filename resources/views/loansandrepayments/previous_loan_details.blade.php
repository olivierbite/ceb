<div class="row" style="background-color: #99C68E">
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.previous_loan_contract_number') }}</label>
    {!! Form::input('text', 'current_loan_contract',$member->latestLoan()->loan_contract,
                  ['class'=>'form-control','disabled'=>true])
    !!}
  </div>
  </div>
  <div class="col-md-2">
  <div class="form-group">
   <label>{{ trans('loan.remaining_installments') }}</label>
    {!! Form::input('text', 'current_number_of_installments',$member->remaining_tranches,
                  ['class'=>'form-control','disabled'=>true])
    !!}
  </div>
  </div>
  <div class="col-md-2">
  <div class="form-group">
   <label>{{ trans('loan.current_monthly_fees') }}</label>
       {!! Form::input('text', 'current_monthly_fees',$member->latestLoan()->monthly_fees,
                  ['class'=>'form-control','disabled'=>true])
    !!}
   </div>
  </div>
  <div class="col-md-2">
  <div class="form-group">
   <label>{{ trans('loan.previous_loan_balance') }}</label>
       {!! Form::input('text', 'current_monthly_fees',($member->exists) ?$member->loanBalance() : 0,
                  ['class'=>'form-control','disabled'=>true])
    !!}
   </div>
  </div>
  <div class="col-md-2">
  <div class="form-group">
   <label>{{ trans('loan.previous_loan_type') }}</label>
       {!! Form::input('text', 'current_monthly_fees',($member->exists) ?$member->latestLoan()->operation_type : 'n/a',
                  ['class'=>'form-control','disabled'=>true])
    !!}
   </div>
  </div>
</div>