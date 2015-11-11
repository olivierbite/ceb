<div class="row">
  {{-- only display additional_installments if we need to deal with installments / echeance --}}
  @if (strpos($regularisationType, 'installments') !== false)
  <div class="col-md-2">
  <div class="form-group">
   <label>{{ trans('loan.additional_installments') }}</label>
      {!! Form::selectRange('additional_installments', 1, $setting->keyValue('loan.maximum.installments'),
            isset($loanInputs['tranches_number'])?$loanInputs['tranches_number']:null,
                   ['class'=>'form-control loan-select','id'=>'numberOfInstallment'])
       !!}
   </div>
  </div>
  @endif

  {{-- only display additional_installments if we need to deal with amount / montant --}}
 
  @if (strpos($regularisationType, 'amount') !== false) 
  <div class="col-md-2">
  <div class="form-group">
   <label>{{ trans('loan.additional_amount_to_repay') }}</label>      
    {!! Form::input('text', 'loan_to_repay',null,
                  ['class'=>'form-control loan-input','id'=>'loanToRepay'])
                  !!}
   </div>
  </div>
    <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.number_of_cheque') }}</label>
  
{!! $errors->first('cheque_number','<label class="has-error">:message</label>') !!} 
  {!! Form::input('text', 'cheque_number',isset($loanInputs['cheque_number'])?$loanInputs['cheque_number']:null,
                  ['class'=>'form-control','id'=>'cheque_number'])
    !!}
  </div>
  </div>
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.bank') }}</label>
    {!! Form::select('bank_id',$banks,
                   isset($loanInputs['bank'])?$loanInputs['bank']:null,
                  ['class'=>'form-control loan-select','id'=>'bank']
      )
  !!}
  </div>
  </div>
  @endif
   <div class="col-md-2">
  <div class="form-group">
   <div class="checkbox checkbox-warning">
          <input id="checkbox2" class="styled" type="checkbox" value="{!! Ceb\Models\Setting::keyValue('loan.administration.fee') !!}" name="administration_fees">
          <label for="checkbox2" style="font-weight: 800;">
             {{ trans('loan.administration_fees') }}
          </label>
      </div>
   </div>
  </div> 
</div>