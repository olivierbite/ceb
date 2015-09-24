@extends('layouts.default')

@section('content_title')
  {{ trans('navigations.regularisation') }}
@stop

@if ($member->exists)
@section('content')

  {{-- @include('loansandrepayments.index_buttons') --}}
   {!! Form::open(['method'=>'POST','url'=>route('loan.complete')]) !!}
    @include('regularisation.client_information_form')
    
    @if ($loan != null )
	    @include('regularisation.form') 
	    @include('regularisation.caution_form')
    @endif

@stop

 @if ($loan != null )
@section('content_footer')
    @include('partials.buttons',['completeRoute'=>'loan.complete','cancelRoute'=>'loan.cancel'])
    {!! Form::close() !!}

@stop
@endif

@else

@section('content')
{{ trans('regularisation.please_search_for_a_member_in_the_above_search_box_before_you_continue') }}
@stop

@endif


@section('scripts')
<script src="{{Url()}}/assets/dist/js/datepickr.js" type="text/javascript"></script>
<script src="{{ Url()}}/assets/dist/js/loanForm.js"></script>
@stop