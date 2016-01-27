{{-- Start by pulling this member profile --}}
<table class="pure-table pure-table-bordered">
<caption> {{ trans('reports.member_who_are_not_contributing') }} </caption>
  	 <thead>
  	 	<tr>
	  	 	<th>{{ trans('member.adhersion_id') }}</th>
	     	<th>{{ trans('member.names') }}</th>
			<th>{{ trans('member.service') }}</th>
			<th>{{ trans('member.last_date_of_contribution') }}</th>
			<th>{{ trans('member.total_contributed_amount') }}</th>
			<th>{{ trans('member.to_pay') }}</th>
	  	</tr>
   	 </thead>
 <tbody>
   @each ('reports.member.item_member_not_contributed', $members, 'member', 'members.no-items')
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