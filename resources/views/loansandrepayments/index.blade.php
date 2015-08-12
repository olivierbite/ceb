@extends('layouts.default')

@section('content_title')
  {{ trans('navigations.loans_and_repayments') }}
@stop

@section('content')

	@if ($completed == true)
		{{-- We have completed the transaction let's print the invoice --}}
	<script type="text/javascript">
	function print(url) {
	  var win = window.open(url, '_blank');
	  win.focus();
	}
	print('{{ route('loan.print') }}');
	</script>
	@endif
	{{-- @include('loansandrepayments.index_buttons') --}}
   {!! Form::open(['method'=>'POST','url'=>route('loans.store')]) !!}
	@include('loansandrepayments.client_information_form')

	@include('loansandrepayments.ordinary_loan_form')

	@include('loansandrepayments.caution_form')

	@include('accounting.form')

   {!! Form::close() !!}
@stop

@section('content_footer')
    @include('partials.buttons',['completeRoute'=>'loan.complete','cancelRoute'=>'loan.cancel'])
@stop


@section('scripts')
<script src="{{Url()}}/assets/dist/js/datepickr.js" type="text/javascript"></script>
<script src="{{ Url()}}/assets/dist/js/loanForm.js"></script>
@stop