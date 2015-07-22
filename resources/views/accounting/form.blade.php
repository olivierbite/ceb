<div class="row">
<div class="col-md-12">
  {{ trans('general.press_plus_to_add_another_field') }}
</div>
</div>

<div class="row">
    <div class="col-md-6 debit_accounts"  >
    <label>{{ trans('loan.debit_account') }}</label>
      <div class="multi-fields">
        <div class="form-group multi-field">
            {!! Form::input('text', 'debit_accounts[]',null, ['class'=>'form-control']) !!}
            <button class="btn btn-danger remove-field-debit">x</button>
         </div>
      </div>
    <button type="button" class="btn btn-success add-field-debit">+</button>
  </div>
  <div class="col-md-6 credit_accounts"  >
    <label>{{ trans('loan.credit_account') }}</label>
      <div class="multi-fields-credit">
        <div class="form-group multi-field">
            {!! Form::input('text', 'credit_accounts[]',null, ['class'=>'form-control']) !!}
            <button class="btn btn-danger remove-field-credit">x</button>
         </div>
      </div>
    <button type="button" class="btn btn-success add-field-credit">+</button>
  </div>
</div>