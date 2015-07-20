<div class="row header-container">
<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" >
 <label>{{ trans('contribution.inistitutions') }}</label>
  {!! Form::select('institutions', $institutions, $institutionId, ['class'=>'form-control','id'=>'institutions']) !!}
</div>
<div class="col-xs-1 col-sm-2 col-md-1 col-lg-2" >
<label>{{ trans('contribution.month') }}</label>

	{!! Form::selectMonth('month',date('m'),['class'=>'form-control']) !!}
</div>

<div class="col-xs-1 col-sm-2 col-md-1 col-lg-2" >
<label>{{ trans('contribution.date') }}</label>

	{!! Form::input('text', 'date', date('Y-m-d'), ['class'=>'form-control','disabled']) !!}
</div>
<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" >
<label>{{ trans('contribution.totalAmount') }}</label>

	{!! Form::input('text', 'totalAmount', number_format($total), ['class'=>'form-control']) !!}
</div>
<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" >
<label>{{ trans('contribution.debit_account') }}</label>

{!! Form::select('debit_account', $accounts,13, ['class'=>'form-control','id'=>'debit_account'])!!}
</div>
<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" >
<label>{{ trans('contribution.credit_account') }}</label>
{!! Form::select('credit_account', $accounts,28, ['class'=>'form-control','id'=>'credit_account'])!!}
</div>
</div>