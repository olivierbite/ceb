<div class="box-body">
<div class="box-header with-border">
  <h3 class="box-title">{{ trans('loan.loan') }}</h3>
  <div class="loan-notifications">
   </div>
</div>
<div class="row">

  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.number_of_installments') }}</label>
  {!! Form::selectRange('tranches_number', 1, $setting->keyValue('loan.maximum.installments'),
                          isset($loanInputs['tranches_number'])?$loanInputs['tranches_number']:null,
                         ['class'=>'form-control loan-select','id'=>'numberOfInstallment'])
    !!}
  </div>
  </div>
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.operation_type') }}</label>
   {!! Form::select('operation_type',
                   $regularisations,
                   isset($loanInputs['operation_type'])?$loanInputs['operation_type']:null,
                  ['class'=>'form-control loan-select','id'=>'operation_type'])
  !!}
   </div>
  </div>

  <?php $administration_fees =  \Ceb\Models\Setting::keyValue('loan.administration.fee'); ?>
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.administration_fees') }}</label>
     {!! Form::select('administration_fees',
                       [$administration_fees=>trans('loan.charging_administration_fees',['charges'=>$administration_fees]),
                        ],null,['class' => 'form-control']) 
    !!} 
  </div>
  </div>
  
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
                  ['class'=>'form-control loan-input','id'=>'interest_on_urgently_loan','disabled'=>true])
    !!}
  </div>
  </div>

{{-- </div>

<div class="row"> --}}
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.net_to_receive') }}</label>
  {!! Form::input('text', 'amount_received',isset($loanInputs['net_to_receive'])?$loanInputs['net_to_receive']:null,
                  ['class'=>'form-control green-input dloan-input','id'=>'netToReceive'])
    !!}
  </div>
  </div>
</div>
</div>