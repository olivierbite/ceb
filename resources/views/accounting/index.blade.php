@extends('layouts.default')

@section('content_title')
  {{ trans('navigations.accounting') }}
@stop

@section('content')
{{-- DO WE NEED TO PRINT PIECE DEBOURSE  --}}

@if (!is_null($transactionid))
	<script type="text/javascript">
		OpenInNewTab("{!! route('piece.disbursed.accounting',['transactionid'=>$transactionid]) !!}")
	</script>
@endif
{!! Form::open(['route'=>'accounting.store']) !!}
	@include('accounting.journal')

	@include('accounting.form')

	@include('partials.buttons',['cancelRoute'=>'accounting.index'])

@stop
