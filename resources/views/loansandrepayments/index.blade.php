@extends('layouts.default')

@section('content_title')
  {{ trans('navigations.loans_and_repayments') }}
@stop

@section('content')
	@include('loansandrepayments.index_buttons')

   {!! Form::open(['method'=>'POST','url'=>route('loans.store')]) !!}
	@include('loansandrepayments.client_information_form')

	@include('loansandrepayments.loan_form')

	@include('loansandrepayments.caution_form')

	@include('accounting.form')

    @include('loansandrepayments.saving_button')
   {!! Form::close() !!}
@stop