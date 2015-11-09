<div class="row" style="background-color: #99C68E">
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.previous_loan_contract_number') }}</label>
    {!! Form::input('text', 'current_loan_contract',$member->loan_contract,
                  ['class'=>'form-control'])
    !!}
  </div>
  </div>
  <div class="col-md-2">
  <div class="form-group">
   <label>{{ trans('loan.remaining_installments') }}</label>
    {!! Form::input('text', 'current_number_of_installments',$member->remaining_tranches,
                  ['class'=>'form-control'])
    !!}
  </div>
  </div>
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.current_loan_to_repay') }}</label>
    {!! Form::input('text', 'current_loan_to_repay',$member->loan_to_repay,
                  ['class'=>'form-control'])
    !!}
  </div>
  </div>
  <div class="col-md-2">
  <div class="form-group">
   <label>{{ trans('loan.current_monthly_fees') }}</label>
       {!! Form::input('text', 'current_monthly_fees',$member->monthly_fees,
                  ['class'=>'form-control'])
    !!}
   </div>
  </div>
    <div class="col-md-2">
  <div class="form-group">
   <label>{{ trans('loan.previous_loan_balance') }}</label>
       {!! Form::input('text', 'current_monthly_fees',($member->exists) ?$member->loanBalance() : 0,
                  ['class'=>'form-control'])
    !!}
   </div>
  </div>
</div>