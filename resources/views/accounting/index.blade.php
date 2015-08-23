@extends('layouts.default')

@section('content_title')
  {{ trans('navigations.accounting') }}
@stop
@section('content')
{!! Form::open(['route'=>'accounting.store']) !!}
	@include('accounting.journal')
	@include('accounting.form')

	@include('partials.saving_cancel_buttons',['route'=>'accounting'])
@stop
@section('scripts')
<script src="{{ Url()}}/assets/dist/js/loanForm.js"></script>
@stop