<div class="box-body even-background">
<div class="box-header with-border">
  <h3 class="box-title">{{ trans('loan.client_information') }}</h3>
</div>
<div class="row">
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('member.adhersion_number') }}</label>
	{!! Form::input('text', 'adhersion_number',null, ['class'=>'form-control']) !!}
  </div>
  </div>
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('member.institution') }}</label>
	{!! Form::input('text', 'institution',null, ['class'=>'form-control']) !!}
  </div>
  </div>
  <div class="col-md-6">
  <div class="form-group">
   <label>{{ trans('member.names') }}</label>
	{!! Form::input('text', 'names',null, ['class'=>'form-control']) !!}
  </div>
  </div>
</div>

<div class="row">
  <div class="col-md-2">
  <div class="form-group">
   <label>{{ trans('member.epargne') }}</label>
	{!! Form::input('text', 'epargne',null, ['class'=>'form-control']) !!}
  </div>
  </div>
  <div class="col-md-2">
  <div class="form-group">
   <label>{{ trans('member.right_to_loan') }}</label>
	{!! Form::input('text', 'right_to_loan',null, ['class'=>'form-control']) !!}
  </div>
  </div>
  <div class="col-md-2">
  <div class="form-group">
   <label>{{ trans('member.balance_of_loan') }}</label>
	{!! Form::input('text', 'balance_of_loan',null, ['class'=>'form-control']) !!}
  </div>
  </div>

  <div class="col-md-2">
  <div class="form-group">
   <label>{{ trans('member.adhersion_date') }}</label>
	{!! Form::input('text', 'adhersion_date',null, ['class'=>'form-control']) !!}
  </div>
  </div>
  <div class="col-md-2">
  <div class="form-group">
   <label>{{ trans('member.letter_date') }}</label>
	{!! Form::input('text', 'letter_date',null, ['class'=>'form-control']) !!}
  </div>
  </div>
  <div class="col-md-2">
  <div class="form-group">
   <label>{{ trans('member.date_of_today') }}</label>
	{!! Form::input('text', 'date_of_today',null, ['class'=>'form-control']) !!}
  </div>
  </div>

</div>
</div>