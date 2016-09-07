<div class="box-body even-background" id="cautionForm">
<div class="box-header with-border">
  <h3 class="box-title">{{ trans('loan.cautions') }}</h3>
</div>
<div class="row">
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.movement_nature') }}</label>
   {!! Form::select('movement_nature',
                   ['saving'=>trans('loan.saving'),
                   'saving_caution'=>trans('loan.saving_caution')],
                   isset($loanInputs['movement_nature'])?$loanInputs['movement_nature']:null,
                  ['class'=>'form-control loan-select','id'=>'type_of_bond']
      )
  !!}

  </div>
  </div>
  <div class="col-md-3">
    @include('loansandrepayments.search',
              ['cautionneur'=>isset($cautionneurs['cautionneur1'])?$cautionneurs['cautionneur1']:null,
              'label'=> trans('loan.cautionneur_number1'),
              'fieldname' =>'cautionneur1'
              ]
            )
  </div>
  <div class="col-md-3">
    @include('loansandrepayments.search',
              ['cautionneur'=>isset($cautionneurs['cautionneur2'])?$cautionneurs['cautionneur2']:null,
              'label'=> trans('loan.cautionneur_number2'),
              'fieldname' =>'cautionneur2'
              ]
            )

  </div>
  <div class="col-md-3">
  <div class="form-group">
   <label>{{ trans('loan.amount_bonded') }}</label>
  {!! Form::input('text', 'amount_bonded',isset($bonded_amount)?$bonded_amount:null, ['class'=>'form-control loan-input','id'=>'amount_bonded']) !!}
  </div>
  </div>
</div>
</div>