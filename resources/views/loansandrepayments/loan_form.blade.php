
<div class="box-body">
<div class="box-header with-border">
  <h3 class="box-title">{{ trans('loan.loan') }}</h3>
</div>
<div class="row">
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.loan_contract_number') }}</label>
	{!! Form::input('text', 'loan_contract_number',null, ['class'=>'form-control']) !!}
  </div>
  </div>
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.number_of_installments') }}</label>
	{!! Form::input('text', 'number_of_installments',null, ['class'=>'form-control']) !!}
  </div>
  </div>
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.wished_amount') }}</label>
	{!! Form::input('text', 'wished_amount',null, ['class'=>'form-control']) !!}
  </div>
  </div>
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.type_of_operation') }}</label>
  {!! Form::input('text', 'type_of_operation',null, ['class'=>'form-control']) !!}
  </div>
  </div>
</div>

<div class="row">
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.loan_to_repay') }}</label>
  {!! Form::input('text', 'loan_to_repay',null, ['class'=>'form-control']) !!}
  </div>
  </div>
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.monthly_installments') }}</label>
  {!! Form::input('text', 'monthly_installments',null, ['class'=>'form-control']) !!}
  </div>
  </div>
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.interests') }}</label>
  {!! Form::input('text', 'interests',null, ['class'=>'form-control']) !!}
  </div>
  </div>
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.interest_on_urgently_loan ') }}</label>
  {!! Form::input('text', 'interest_on_urgently_loan',null, ['class'=>'form-control']) !!}
  </div>
  </div>
</div>

<div class="row">
  <div class="col-md-4">
  <div class="form-group">
   <label>{{ trans('loan.net_to_receive') }}</label>
  {!! Form::input('text', 'net_to_receive',null, ['class'=>'form-control']) !!}
  </div>
  </div>
  <div class="col-md-4">
  <div class="form-group">
   <label>{{ trans('loan.number_of_cheque') }}</label>
  {!! Form::input('text', 'number_of_cheque',null, ['class'=>'form-control']) !!}
  </div>
  </div>
  <div class="col-md-4">
  <div class="form-group">
   <label>{{ trans('loan.bank') }}</label>
  {!! Form::input('text', 'bank',null, ['class'=>'form-control']) !!}
  </div>
  </div>
</div>
</div>