{{-- Start by pulling this member profile --}}
<table class="pure-table pure-table-bordered">
<caption> {{ trans('reports.member_with_irregularite_in_refunding') }} </caption>
  	 <thead>
  	 	<tr>
	  	 	<th>{{ trans('member.adhersion_id') }}</th>
	     	<th>{{ trans('member.names') }}</th>
			<th>{{ trans('member.service') }}</th>
			<th>{{ trans('member.total_contribution') }}</th>
			<th>{{ trans('member.loan_balance') }}</th>
			<th>{{ trans('member.balance') }}</th>
			<th>{{ trans('member.date') }}</th>
			<th>{{ trans('member.wording') }}</th>
			<th>{{ trans('member.tranches_to_pay') }}</th>
			<th>{{ trans('member.paid_tranches') }}</th>
			<th>{{ trans('member.difference') }}</th>
	  	</tr>
   	 </thead>
 <tbody>
   @each ('reports.member.item_refund_irregularities', $members, 'member', 'members.no-items')
 </tbody>
</table>
<table class="pure-table pure-table-bordered">
  	 	<tr>
	  	 	<td>
	  	 		{{ trans('report.done_by') }} <br/>
	  	 		<?php $user = Sentry::getUser(); ?>
				{!!  $user->first_name !!} {!! $user->last_name !!}
	  	 	</td>
	     	<td>{{ trans('report.gerant') }} <br/>
				{!! (new Ceb\Models\Setting)->get('general.gerant') !!}
			</td>
	  	</tr>
 </table>