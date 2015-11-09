<div class="row">
 
    <div class="col-md-2">
  <div class="form-group">
   <label>{{ trans('loan.additional_installments') }}</label>
      {!! Form::selectRange('tranches_number', 1, $setting->keyValue('loan.maximum.installments'),
            isset($loanInputs['tranches_number'])?$loanInputs['tranches_number']:null,
                   ['class'=>'form-control loan-select','id'=>'numberOfInstallment'])
       !!}
   </div>
  </div>
  <div class="col-md-4">
  <div class="form-group">
   <label>{{ trans('loan.additional_amount_to_repay') }}</label>      
    {!! Form::input('text', 'loan_to_repay',null,
                  ['class'=>'form-control loan-input','id'=>'loanToRepay'])
                  !!}
   </div>
  </div>
   <div class="col-md-2">
  <div class="form-group">
   <div class="checkbox checkbox-warning">
                        <input id="checkbox2" class="styled" type="checkbox" checked="">
                        <label for="checkbox2" style="font-weight: 800;">
                           {{ trans('loan.administration_fees') }}
                        </label>
                    </div>

   </div>
  </div> 
</div>