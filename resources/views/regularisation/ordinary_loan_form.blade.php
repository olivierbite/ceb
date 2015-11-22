<div class="box-body">
<div class="box-header with-border">
  <h3 class="box-title">{{ trans('loan.regularisation') }}</h3>
  <div class="loan-notifications">
   </div>
</div>
<div class="row">
 @if ((strpos($loanInputs['operation_type'], 'installment') !== false) || empty($loanInputs['operation_type']))

  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.number_of_installments') }}</label>
  {!! Form::selectRange('tranches_number', 1, $setting->keyValue('loan.maximum.installments'),
                          isset($loanInputs['tranches_number'])?$loanInputs['tranches_number']:0,
                         ['class'=>'form-control loan-select','id'=>'numberOfInstallment'])
    !!}
  </div>
  </div>
 @endif
 @if (strpos($loanInputs['operation_type'], 'amount') !== false)
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.additional_amount') }}</label>
  {!! Form::input('text', 'additional_amount',isset($loanInputs['additional_amount'])?$loanInputs['additional_amount']:0,
                  ['class'=>'form-control loan-input','id'=>'additional_amount'])
    !!}
  </div>
  </div>
  @endif
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.regularisation_type') }}</label>
   {!! Form::select('operation_type',
                   $regularisations,
                   isset($loanInputs['operation_type'])?$loanInputs['operation_type']:null,
                  ['class'=>'form-control loan-select','id'=>'operation_type'])
  !!}
   </div>
  </div>

 @if (strpos($loanInputs['operation_type'], 'amount') !== false)
  <?php $administration_fees =  \Ceb\Models\Setting::keyValue('loan.administration.fee'); ?>
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.charges_rate') }}</label>
     {!! Form::select('charges_rate',
                       [ 0 => trans('loan.charging_administration_fees',['charges'=>0]),
                        $administration_fees=>trans('loan.charging_administration_fees',['charges'=>$administration_fees]),
                        ],null,['class' => 'form-control loan-select additinal_charges_rate']) 
    !!} 
  </div>
  </div>
  @endif

  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.monthly_fees') }}</label>
  {!! Form::input('text', 'monthly_fees',isset($loanInputs['monthly_fees'])?$loanInputs['monthly_fees']:0,
                  ['class'=>'form-control loan-input','id'=>'new_monthly_fees'])
    !!}
  </div>
  </div>
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.interests_to_pay') }}</label>
  {!! Form::input('text', 'interests_to_pay',isset($loanInputs['interests_to_pay'])?$loanInputs['interests_to_pay']:0,
                  ['class'=>'form-control blue-input loan-input','id'=>'interests_to_pay','readonly'=>true])
    !!}
  </div>
  </div>
 @if (strpos($loanInputs['operation_type'], 'amount') !== false)
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.additinal_charges ') }}</label>
  {!! Form::input('text', 'additinal_charges',isset($loanInputs['additinal_charges'])?$loanInputs['additinal_charges']:0,
                  ['class'=>'form-control loan-input','id'=>'additinal_charges','readonly'=>true])
    !!}
  </div>
  </div>
 @endif
 <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.new_installments') }}</label>
  {!! Form::input('text', 'new_installments',isset($loanInputs['new_installments'])?$loanInputs['new_installments']:0,
                  ['class'=>'form-control orange-input loan-input','id'=>'new_installments','readonly'=>true])
    !!}
  </div>
  </div>

 <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.remaining_interest') }}</label>
  {!! Form::input('text', 'remaining_interest',isset($loanInputs['remaining_interest'])?$loanInputs['remaining_interest']:0,
                  ['class'=>'form-control orange-input loan-input','id'=>'remaining_interest','readonly'=>true])
    !!}
  </div>
  </div>  

 @if (strpos($loanInputs['operation_type'], 'amount') !== false)
  <div class="col-md-4">
  <div class="form-group">
   <label>{{ trans('loan.net_to_receive') }}</label>
  {!! Form::input('text', 'amount_received',isset($loanInputs['net_to_receive'])?$loanInputs['net_to_receive']:0,
                  ['class'=>'form-control green-input dloan-input','id'=>'netToReceive','readonly'=>true])
    !!}
  </div>
  </div>
  <div class="col-md-4">
  <div class="form-group">
   <label>{{ trans('loan.charges_payslip_reference_number') }}</label>
  {!! Form::input('text', 'reference_number',isset($loanInputs['reference_number'])?$loanInputs['reference_number']:null,
                  ['class'=>'form-control yellow-input loan-input','id'=>'referenceRumber'])
    !!}
  </div>
  </div>
   @endif
</div>
</div>