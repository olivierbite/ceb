
<div class="box-body">
<div class="box-header with-border">
  <h3 class="box-title">{{ trans('loan.loan') }}</h3>
  <div class="loan-notifications">
   </div>
</div>
<div class="row">
  @if (isset($loanInputs['tranches_number']) && strpos($loanInputs['tranches_number'],'ordinary_loan'))
    {{-- Show contract number when this one is not an ordinary loan --}}
  
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.loan_contract_number') }}</label>
	{!! Form::input('text', 'loan_contract',isset($loanInputs['loan_contract'])?$loanInputs['loan_contract']:null,
                  ['class'=>'form-control loan-input'])
    !!}
  </div>
  </div>
@endif
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.number_of_installments') }}</label>
	{!! Form::selectRange('tranches_number', 1, env('LOAN_MAXIMUM_INSTALLMENT',72),
                          isset($loanInputs['tranches_number'])?$loanInputs['tranches_number']:null,
                         ['class'=>'form-control loan-select','id'=>'numberOfInstallment'])
    !!}
  </div>
  </div>
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.wished_amount') }}</label>
  	{!! Form::input('text', 'wished_amount',isset($loanInputs['wished_amount'])?$loanInputs['wished_amount']:null,
                  ['class'=>'form-control loan-input','id'=>'wished_amount'])
    !!}
  </div>
  </div>
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.operation_type') }}</label>
   {!! Form::select('operation_type',
                   $loanTypes,
                   isset($loanInputs['operation_type'])?$loanInputs['operation_type']:null,
                  ['class'=>'form-control loan-select','id'=>'operation_type'])
  !!}
   </div>
  </div>

  @if (isset($loanInputs['tranches_number']) && !strpos($loanInputs['tranches_number'],'ordinary_loan'))
    {{-- Show contract number when this one is not an ordinary loan --}}
  
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.remaining_installements') }}</label>
  {!! Form::input('text', 'remaining_installements',isset($loanInputs['remaining_installements'])?$loanInputs['remaining_installements']:null,
                  ['class'=>'form-control loan-input'])
    !!}
  </div>
  </div>
@endif
</div>

<div class="row">
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.loan_to_repay') }}</label>
  {!! Form::input('text', 'loan_to_repay',isset($loanInputs['loan_to_repay'])?$loanInputs['loan_to_repay']:null,
                  ['class'=>'form-control loan-input','id'=>'loanToRepay'])
    !!}
  </div>
  </div>
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.monthly_installments') }}</label>
  {!! Form::input('text', 'monthly_fees',isset($loanInputs['monthly_fees'])?$loanInputs['monthly_fees']:null,
                  ['class'=>'form-control loan-input','id'=>'monthlyInstallments'])
    !!}
  </div>
  </div>
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.interests') }}</label>
  {!! Form::input('text', 'interests',isset($loanInputs['interests'])?$loanInputs['interests']:null,
                  ['class'=>'form-control loan-input','id'=>'interests'])
    !!}
  </div>
  </div>
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.interest_on_urgently_loan ') }}</label>
  {!! Form::input('text', 'interest_on_urgently_loan',isset($loanInputs['interest_on_urgently_loan'])?$loanInputs['interest_on_urgently_loan']:null,
                  ['class'=>'form-control loan-input','id'=>'interest_on_urgently_loan'])
    !!}
  </div>
  </div>
</div>

<div class="row">
  <div class="col-md-4">
  <div class="form-group">
   <label>{{ trans('loan.net_to_receive') }}</label>
  {!! Form::input('text', 'amount_received',isset($loanInputs['net_to_receive'])?$loanInputs['net_to_receive']:null,
                  ['class'=>'form-control loan-input','id'=>'netToReceive'])
    !!}
  </div>
  </div>
  <div class="col-md-4">
  <div class="form-group">
   <label>{{ trans('loan.number_of_cheque') }}</label>
  
{!! $errors->first('cheque_number','<label class="has-error">:message</label>') !!} 
  {!! Form::input('text', 'cheque_number',isset($loanInputs['cheque_number'])?$loanInputs['cheque_number']:null,
                  ['class'=>'form-control loan-input','id'=>'cheque_number'])
    !!}
  </div>
  </div>
  <div class="col-md-4">
  <div class="form-group">
   <label>{{ trans('loan.bank') }}</label>
    {!! Form::select('bank_id',
                   ['BK'=>'Bank of Kigali',
                   'BCR'=>'Bank Commercial du Rwanda'],
                   isset($loanInputs['bank'])?$loanInputs['bank']:null,
                  ['class'=>'form-control loan-select','id'=>'bank']
      )
  !!}
  </div>
  </div>
</div>
</div>