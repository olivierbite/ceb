  <label>{{ trans('general.libelle') }}</label>
  {!! Form::text('wording', isset($wording)?$wording:null, ['class'=>'form-control','placeholder'=>trans('general.reason_for_this_transaction')]) !!}