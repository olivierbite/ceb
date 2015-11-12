@extends('layouts.default')

@section('content_title')
  {{ trans('navigations.accounting') }}
@stop

@section('content')
{!! Form::open(['route'=>'accounting.store','class'=>'accounting-form']) !!}
	@include('accounting.journal')

	@include('accounting.form')

	@include('partials.buttons',['cancelRoute'=>'accounting.index'])

@stop
