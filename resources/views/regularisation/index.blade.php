@extends('layouts.default')

@section('content_title')
  {{ trans('navigations.regularisation') }}
@stop

@if ($member->exists)
@section('content')

  {{-- @include('loansandrepayments.index_buttons') --}}
   {!! Form::open(['method'=>'PUT','url'=>route('regularisation.update',$member->latestLoan()->id)]) !!}
    @include('regularisation.client_information_form')
     {!! Form::hidden('regularisationType', $regularisationType) !!}
    @if (!empty($member))
    @if ($member->has_active_loan == true)
      @include('loansandrepayments.previous_loan_details',['member'=>$member])
    @endif
  @endif
  
  @include('regularisation.form')

  @include('partials.wording')
  
  @if ($regularisationType == 'both' || $regularisationType == 'amount') 
    @include('accounting.form')
  @endif

@stop

 @if ($loan != null )
@section('content_footer')
     @include('partials.buttons',['cancelRoute'=>'regularisation.index'])
    {!! Form::close() !!}
@endsection
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