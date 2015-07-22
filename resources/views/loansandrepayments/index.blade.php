@extends('layouts.default')

@section('content_title')
  {{ trans('navigations.loans_and_repayments') }}
@stop

@section('content')
	@include('loansandrepayments.index_buttons')

	@include('loansandrepayments.client_information_form')

	@include('loansandrepayments.loan_form')

	@include('loansandrepayments.caution_form')

	@include('accounting.form')
@stop