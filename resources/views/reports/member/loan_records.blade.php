@extends('reports.member.layouts.default')

@section('content')
  <table class="ui table">
  	 <thead>
  	 	<tr>
	     	<th>{{ trans('loan.nature') }}</th>
			<th>{{ trans('loan.operation_type') }}</th>
			<th>{{ trans('loan.wording') }}</th>
			<th>{{ trans('loan.loan') }}</th>
	        <th>{{ trans('loan.interests') }}</th>
	        <th>{{ trans('loan.installment_payments') }}</th>
	        <th>{{ trans('loan.installements') }}</th>
	  	</tr>
   	 </thead>
 <tbody>
   @each ('reports.member.item_loan_record', $member, 'member', 'members.no-items')
 </tbody>
  </table>

@stop