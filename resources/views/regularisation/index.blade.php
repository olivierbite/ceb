@extends('layouts.default')

@section('content_title')
  {{ trans('navigations.regularisation') }} {{ trans('regularisation.'.$regularisationType) }}
@stop
@section('content')

@if (!is_null($member))
  {{-- @include('loansandrepayments.index_buttons') --}}
   {!! Form::open(['method'=>'POST','url'=>route('regularisation.regulate')]) !!}
    @include('regularisation.client_information_form')
       {!! Form::hidden('regularisationType', $regularisationType) !!}
       {!! Form::hidden('loan_id', $member->latestLoan()->id) !!}
       {!! Form::hidden('member_id', $member->id) !!}

    @if (!empty($member))
      @if ($member->has_active_loan == true)
        @include('loansandrepayments.previous_loan_details',['member'=>$member])
      @endif
  @endif
  
    @include('regularisation.form')

    @include('partials.wording')
    
    @if (strpos($regularisationType, 'amount') !== false) 
      @include('accounting.form')
    @endif

  @endif

@endsection

  @section('content_footer')
          @if (is_null($loan))
            {{ trans('regularisation.please_search_for_a_member_in_the_above_search_box_before_you_continue') }}
          @else
               @include('partials.buttons',['cancelRoute'=>'regularisation.index'])
          @endif
        {!! Form::close() !!}
  @endsection

@section('scripts')
  <script src="{{Url()}}/assets/dist/js/datepickr.js" type="text/javascript"></script>
  <!-- <script src="{{ Url()}}/assets/dist/js/loanForm.js"></script> -->
  <script type="text/javascript" src="{{route('assets.js.loanform')}}"></script>
@endsection