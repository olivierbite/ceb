@extends('layouts.default')

@section('content_title')
  {{ trans('navigations.loans_and_repayments') }}
@stop

@section('content')
	{{-- @include('loansandrepayments.index_buttons') --}}

   {!! Form::open(['method'=>'POST','url'=>route('loans.store')]) !!}
	@include('loansandrepayments.client_information_form')

	@include('loansandrepayments.ordinary_loan_form')

	@include('loansandrepayments.caution_form')

	@include('accounting.form')


   {!! Form::close() !!}
     <script src="{{Url()}}/assets/dist/js/datepickr.js" type="text/javascript"></script>
    <script src="{{Url()}}/assets/dist/js/date.js" type="text/javascript"></script>
@stop

@section('content_footer')
    @include('loansandrepayments.saving_button')
@stop