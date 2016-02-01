{{-- Start by pulling this member profile --}}
<table class="pure-table pure-table-bordered">
<caption> {{ trans('reports.member_loan_balance') }} </caption>
  	 <thead>
  	 	<tr>
	  	 	<th>{{ trans('member.adhersion_id') }}</th>
	     	<th>{{ trans('member.names') }}</th>
			<th>{{ trans('member.institution') }}</th>
			<th>{{ trans('member.service') }}</th>
			<th>{{ trans('account.balance') }}</th>
	  	</tr>
   	 </thead>
 <tbody>
   @each ('reports.member.item_memberloans', $members, 'member', 'members.no-items')
   <tr>
	  	 	<th colspan="4">{{ trans('member.service') }}</th>
			<th>{!! number_format(abs($members->sum('balance'))) !!}</th>
	  	</tr>
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