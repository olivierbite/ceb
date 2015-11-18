<?php $loan = $member->latest_loan; ?>
<div class="row" style="background-color: #99C68E;margin-right:0px;margin-left: 0px;">
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.previous_loan_contract_number') }}</label>
    {!! Form::input('text', 'current_loan_contract',$loan->loan_contract,
                  ['class'=>'form-control','disabled'=>true])
    !!}
  </div>
  </div>
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.remaining_installments') }}</label>
    {!! Form::input('text', 'current_number_of_installments',$member->remaining_tranches,
                  ['class'=>'form-control remaining_tranches','disabled'=>true])
    !!}
  </div>
  </div>
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.current_monthly_fees') }}</label>
       {!! Form::input('text', 'current_monthly_fees',(int) $loan->monthly_fees,
                  ['class'=>'form-control','disabled'=>true])
    !!}
   </div>
  </div>
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.previous_loan_balance') }}</label>
       {!! Form::input('text', 'previous_loan_balance',(int) $member->loan_balance,
                  ['class'=>'form-control previous_loan_balance','disabled'=>true])
    !!}
   </div>
  </div>
  <div class="col-md-4">
  <div class="form-group">
   <label>{{ trans('loan.previous_loan_type') }}</label>
       {!! Form::input('text', 'previous_loan_type',$loan->operation_type ,
                  ['class'=>'form-control','disabled'=>true])
    !!}
   </div>
  </div>
    <div class="col-md-8">
  <div class="form-group">
   <label>{{ trans('loan.wording') }}</label>
       {!! Form::input('text', 'prvious_wording',$loan->comment ,
                  ['class'=>'form-control','disabled'=>true])
    !!}
   </div>
  </div>
</div>