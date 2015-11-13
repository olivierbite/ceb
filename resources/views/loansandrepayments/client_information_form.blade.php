<div class="box-body even-background">
<div class="box-header with-border">
  <h3 class="box-title">{{ trans('loan.client_information') }}</h3>
</div>
<div class="row">
  <div class="col-md-1">
  <div style="width:70px;border:2px solid rgba(0,0,0,0.8);">
    @include('files.show',['filename'=>$member->photo])
  </div>
  </div>
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('member.adhersion_number') }}</label>
	{!! Form::input('text', 'adhersion_id',isset($member)?$member->adhersion_id:null, ['class'=>'form-control']) !!}
  </div>
  </div>
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('member.institution') }}</label>
	{!! Form::input('text', 'member[institution]',isset($member->institution->name)?$member->institution_name:null, ['class'=>'form-control']) !!}
  </div>
  </div>
  <div class="col-md-5">
  <div class="form-group">
   <label>{{ trans('member.names') }}</label>
	{!! Form::input('text', 'member[names]',isset($member)?$member->names:null, ['class'=>'form-control']) !!}
  </div>
  </div>
</div>

<div class="row">
  <div class="col-md-2">
  <div class="form-group">
   <label>{{ trans('member.contributions') }}</label>
	{!! Form::input('text', 'member[contributions]',isset($member)?number_format((int)$member->total_contribution):0,
   ['class'=>'form-control green-input','id'=>'totalContributions']) !!}
  </div>
  </div>
  <div class="col-md-2">
  <div class="form-group">
   <label>{{ trans('member.right_to_loan') }}</label>
	{!! Form::input('text', 'member[right_to_loan]',number_format((int) $rightToLoan),
             ['class'=>'form-control blue-input','id'=>'rightToLoan']) !!}
  </div>
  </div>
  <div class="col-md-2">
  <div class="form-group">
   <label>{{ trans('member.balance_of_loan') }}</label>
	{!! Form::input('text', 'member[balance_of_loan]',isset($member)?number_format((int)$member->loan_balance):0, ['class'=>'form-control orange-input']) !!}
  </div>
  </div>
  <div class="col-md-2">
  <div class="form-group">
   <label>{{ trans('member.adhersion_date') }}</label>
	{!! Form::input('text', 'member[adhersion_date]',($member->created_at!=null)?$member->created_at->format('d-m-Y'):null, ['class'=>'form-control']) !!}
  </div>
  </div>
  <div class="col-md-2">
  <div class="form-group">
   <label>{{ trans('member.letter_date') }}</label>
	{!! Form::input('text', 'letter_date',date('Y-m-d'), ['class'=>'form-control loan-input','id'=>'letter_date']) !!}
  </div>
  </div>
  <div class="col-md-2">
  <div class="form-group">
   <label>{{ trans('member.date_of_today') }}</label>
	{!! Form::input('text', 'date_of_today',date('Y-m-2'), ['class'=>'form-control loan-input','id'=>'today']) !!}
  </div>
  </div>
</div>
</div>