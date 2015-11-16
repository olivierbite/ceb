@extends('layouts.popup')
@section('content')
{!! Form::open(['route'=>'loan.unblock.store','method'=>'POST']) !!}

{!! Form::hidden('loanid', $loanid) !!}

<div class="row">
    <div class="col-md-12">
  <div class="form-group">
   <label>{{ trans('loan.number_of_cheque') }}</label>
  
{!! $errors->first('cheque_number','<label class="has-error">:message</label>') !!} 
  {!! Form::input('text', 'cheque_number',null,['class'=>'form-control','id'=>'cheque_number'])
    !!}
  </div>
  </div>
  <div class="col-md-12">
  <div class="form-group">
   <label>{{ trans('loan.bank') }}</label>
    {!! Form::select('bank_id',$banks,null,['class'=>'form-control loan-select','id'=>'bank']
      )
  !!}
  </div>
  </div>
  <div class="col-md-12">
    <button class="btn btn-success col-md-12"><i class="fa fa-unlock-alt"></i> {{ trans('loan.unblock') }}</button>
  </div>
</div>

{!! Form::close() !!}
@endsection