@extends('layouts.default')

@section('content')

    <a class="ui left labeled icon green button no-data-button" href="{{ route('customers.create') }}" onclick="modal(this,38)">
  <i class="plus icon"></i>
  {{ trans('customer.add') }}
  </a>

  <table class="ui table">
  	 <thead>
  	 	<tr>
  	 		<th>{{ trans('customer.email') }}</th>
  	 		<th>{{ trans('customer.description') }}</th>
  	 		<th>{{ trans('customer.livemode') }}</th>
  	 		<th><i class="setting icon"></i></th>
  	 	</tr>
   	 </thead>
 <tbody>
   @each ('customers.item', $customers, 'customer', 'customers.no-items')
 </tbody>
  </table>


@stop
