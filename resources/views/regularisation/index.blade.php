@extends('layouts.default')

@section('content_title')
  {{ trans('navigations.regularisation') }}
@stop

@section('content')

  {{-- @include('loansandrepayments.index_buttons') --}}
   {!! Form::open(['method'=>'POST','url'=>route('loan.complete')]) !!}
    @include('loansandrepayments.client_information_form')
    
    @include('regularisation.form') {{-- This is special loan --}}

    @include('loansandrepayments.caution_form')
@stop

@section('content_footer')
    @include('partials.buttons',['completeRoute'=>'loan.complete','cancelRoute'=>'loan.cancel'])
    {!! Form::close() !!}
@stop


@section('scripts')
<script src="{{Url()}}/assets/dist/js/datepickr.js" type="text/javascript"></script>
<script src="{{ Url()}}/assets/dist/js/loanForm.js"></script>
@stop