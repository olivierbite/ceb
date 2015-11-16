<div class="row">
    <div class="col-md-4">
  <div class="form-group">
   <label>{{ trans('loan.number_of_cheque') }}</label>
  
{!! $errors->first('cheque_number','<label class="has-error">:message</label>') !!} 
  {!! Form::input('text', 'cheque_number',isset($loanInputs['cheque_number'])?$loanInputs['cheque_number']:null,
                  ['class'=>'form-control','id'=>'cheque_number'])
    !!}
  </div>
  </div>
  <div class="col-md-4">
  <div class="form-group">
   <label>{{ trans('loan.bank') }}</label>
    {!! Form::select('bank_id',$banks,
                   isset($loanInputs['bank'])?$loanInputs['bank']:null,
                  ['class'=>'form-control loan-select','id'=>'bank']
      )
  !!}
  </div>
  </div>
</div>