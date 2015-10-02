@include('partials.landscapecss')
<table class="ui table">
  	 <thead>
  	 	<tr>
	  	 	<th>{{ trans('general.date') }}</th>
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
   @each ('reports.member.item_loan_record', $member->loans, 'loan', 'members.no-items')
 </tbody>
  </table>
