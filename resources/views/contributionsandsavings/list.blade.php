@extends('layouts.default')

@section('content_title')
  {{ trans('navigations.contributions') }}
@stop

@section('content')
  <a class="btn btn-primary" href="{{ route('contributions.create')}}">
  <i class="fa fa-plus"></i>
  {{ trans('contribution.add') }}
  </a>

  <table class="ui table">
  	 <thead>
  	 	<tr>
      <th>{{ trans('contribution.adhersion_number') }}</th>
  	 		<th>{{ trans('contribution.names') }}</th>
  	 		<th>{{ trans('contribution.institution') }}</th>
  	 		<th>{{ trans('contribution.service') }}</th>
        <th>{{ trans('contribution.nid') }}</th>
        <th>{{ trans('contribution.district') }}</th>
        <th>{{ trans('contribution.adhersion_date') }}</th>

  	 		<th><i class="fa fa-gear"></i></th>
  	 	</tr>
   	 </thead>
 <tbody>
   @each ('contributions.item', $contributions, 'contribution', 'contributionsandsavings.no-items')
 </tbody>
  </table>
@stop