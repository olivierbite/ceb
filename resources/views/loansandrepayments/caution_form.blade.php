
<div class="box-body even-background">
<div class="box-header with-border">
  <h3 class="box-title">{{ trans('loan.cautions') }}</h3>
</div>
<div class="row">
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.type_of_bond') }}</label>
	{!! Form::input('text', 'caution[type_of_bond]',null, ['class'=>'form-control']) !!}
  </div>
  </div>
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.cautionneur_number1') }}</label>
	{!! Form::input('text', 'caution[cautionneur_number1]',null, ['class'=>'form-control']) !!}
  </div>
  </div>
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.cautionneur_number2') }}</label>
	{!! Form::input('text', 'caution[cautionneur_number2]',null, ['class'=>'form-control']) !!}
  </div>
  </div>
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.amount_bonded') }}</label>
  {!! Form::input('text', 'caution[amount_bonded]',null, ['class'=>'form-control']) !!}
  </div>
  </div>
</div>

</div>