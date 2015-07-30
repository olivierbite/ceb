<div class="box-body even-background">
<div class="box-header with-border">
  <h3 class="box-title">{{ trans('loan.cautions') }}</h3>
</div>
<div class="row">
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.type_of_bond') }}</label>
	{!! Form::input('text', 'type_of_bond',null, ['class'=>'form-control']) !!}
  </div>
  </div>
  <div class="col-md-3">
    @include('loansandrepayments.search',['label'=> trans('loan.cautionneur_number1'),'fieldname' =>'cautionneur1'])
  </div>
  <div class="col-md-3">
    @include('loansandrepayments.search',['label'=> trans('loan.cautionneur_number2'),'fieldname' =>'cautionneur2'])
  </div>
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.amount_bonded') }}</label>
  {!! Form::input('text', 'amount_bonded',null, ['class'=>'form-control']) !!}
  </div>
  </div>
</div>
</div>