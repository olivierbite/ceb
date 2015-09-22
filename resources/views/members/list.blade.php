@extends('layouts.default')

@section('content_title')
  {{ trans('navigations.members') }}
@stop

@section('content')
 <a class="btn btn-primary" href="{{ route('members.create')}}">
  <i class="fa fa-plus"></i>
  {{ trans('member.add') }}
  </a>
  {!! $members->render() !!}
  <table class="ui table">
  	 <thead>
  	 	<tr>
      <th>{{ trans('member.adhersion_number') }}</th>
  	 		<th>{{ trans('member.names') }}</th>
  	 		<th>{{ trans('member.institution') }}</th>
  	 		<th>{{ trans('member.service') }}</th>
        <th>{{ trans('member.nid') }}</th>
        <th>{{ trans('member.district') }}</th>
        <th>{{ trans('member.adhersion_date') }}</th>

  	 		<th><i class="fa fa-gear"></i></th>
  	 	</tr>
   	 </thead>
 <tbody>
   @each ('members.item', $members, 'member', 'members.no-items')
 </tbody>
  </table>


@stop
