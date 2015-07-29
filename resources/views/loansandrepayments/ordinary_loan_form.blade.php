
<div class="box-body">
<div class="box-header with-border">
  <h3 class="box-title">{{ trans('loan.loan') }}</h3>
  <div class="loan-notifications">
   </div>
</div>
<div class="row">
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.loan_contract_number') }}</label>
	{!! Form::input('text', 'loan_contract_number',isset($loanInputs['loan_contract_number'])?$loanInputs['loan_contract_number']:null,
                  ['class'=>'form-control loan-input'])
    !!}
  </div>
  </div>
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.number_of_installments') }}</label>
	{!! Form::selectRange('number_of_installments', 1, 48, isset($loanInputs['number_of_installments'])?$loanInputs['number_of_installments']:null,
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
                   ['ordinary_loan'=>'Ordinary Loan',
                   'urgent_ordinary_loan'=>'Urgent ordinary loan'],
                   isset($loanInputs['operation_type'])?$loanInputs['operation_type']:null,
                  ['class'=>'form-control loan-select','id'=>'operation_type'])
  !!}
   </div>
  </div>
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
  {!! Form::input('text', 'monthly_installments',isset($loanInputs['monthly_installments'])?$loanInputs['monthly_installments']:null,
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
  {!! Form::input('text', 'net_to_receive',isset($loanInputs['net_to_receive'])?$loanInputs['net_to_receive']:null,
                  ['class'=>'form-control loan-input','id'=>'netToReceive'])
    !!}
  </div>
  </div>
  <div class="col-md-4">
  <div class="form-group">
   <label>{{ trans('loan.number_of_cheque') }}</label>
  {!! Form::input('text', 'number_of_cheque',isset($loanInputs['number_of_cheque'])?$loanInputs['number_of_cheque']:null,
                  ['class'=>'form-control loan-input'])
    !!}
  </div>
  </div>
  <div class="col-md-4">
  <div class="form-group">
   <label>{{ trans('loan.bank') }}</label>
  {!! Form::input('text', 'bank',isset($loanInputs['bank'])?$loanInputs['bank']:null,
                  ['class'=>'form-control loan-input'])
    !!}
  </div>
  </div>
</div>
</div>