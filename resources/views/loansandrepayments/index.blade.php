@extends('layouts.default')

@section('content_title')
  {{ trans('navigations.loans') }}
@stop

@section('content')

	@if (!empty($loanId))
    {{-- We have completed the transaction let's print the invoice --}}
	<script type="text/javascript">
	function print(url) {
	  var win = window.open(url, '_blank');
	  win.focus();
	}
	 // print('{!! route('reports.members.contracts.loan',['loanId' => $loanId,'excel'=>0]) !!}');
	</script>
	@endif

	{{-- @include('loansandrepayments.index_buttons') --}}
   {!! Form::open(['method'=>'POST','url'=>route('loan.complete')]) !!}
	@include('loansandrepayments.client_information_form')
    
	{{-- 
		If the member has been selected then check if he has 
		 active loan if he does display active loans information
	 --}}

	@if (!empty($member))
		@if ($member->has_active_loan == true && !is_null($member->latest_loan))
			@include('loansandrepayments.previous_loan_details',['member'=>$member])
		@endif
	@endif

    @include('loansandrepayments.ordinary_loan_form')

	 {{-- THIS PLACE USED TO HOLD CAUTION FORM	 --}}
	<?php $wording = isset($wording) ? $wording : trans('loan.giving_loan_to',['loantype'=>trans('loans.'.$loanInputs['operation_type']),'names'=>$member->names]) ?>
	@include('partials.wording')

	@include('accounting.form')
@stop
@section('content_footer')
    @include('partials.buttons',['completeRoute'=>'loan.complete','cancelRoute'=>'loan.cancel'])
    {!! Form::close() !!}
@stop