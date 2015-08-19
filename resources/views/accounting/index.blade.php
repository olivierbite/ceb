@extends('layouts.default')

@section('content_title')
  {{ trans('navigations.accounting') }}
@stop
@section('content')
	@include('accounting.form')
@stop
@section('scripts')
<script src="{{ Url()}}/assets/dist/js/loanForm.js"></script>
@stop