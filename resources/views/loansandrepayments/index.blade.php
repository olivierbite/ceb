@extends('layouts.default')

@section('content_title')
  {{ trans('navigations.loans_and_repayments') }}
@stop

@section('content')

	@if ($currentMemberId !=null)
		{{-- We have completed the transaction let's print the invoice --}}
	<script type="text/javascript">
	function print(url) {
	  var win = window.open(url, '_blank');
	  win.focus();
	}
	print('{!! route('reports.contracts.loan',['memberId' => $currentMemberId]) !!}');
	</script>
	@endif
	{{-- @include('loansandrepayments.index_buttons') --}}
   {!! Form::open(['method'=>'POST','url'=>route('loan.complete')]) !!}
	@include('loansandrepayments.client_information_form')

	@if (strpos($loanInputs['operation_type'], 'ordinary_loan') !== FALSE)

		@include('loansandrepayments.ordinary_loan_form')  {{-- This is ordinary loan type --}}

	@elseif (strpos($loanInputs['operation_type'], 'special_loan') !== FALSE)

		@include('loansandrepayments.special_loan_form') {{-- This is special loan --}}

	@elseif (strpos($loanInputs['operation_type'], 'social_loan') !== FALSE)

		@include('loansandrepayments.ordinary_loan_form') {{-- This is special loan --}}

	@endif

	@include('loansandrepayments.caution_form')

	@include('accounting.form')

   
@stop

@section('content_footer')
    @include('partials.buttons',['completeRoute'=>'loan.complete','cancelRoute'=>'loan.cancel'])
    {!! Form::close() !!}
@stop


@section('scripts')
<script src="{{Url()}}/assets/dist/js/datepickr.js" type="text/javascript"></script>
<script src="{{ Url()}}/assets/dist/js/loanForm.js"></script>
@stop