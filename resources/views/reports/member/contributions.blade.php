@include('partials.landscapecss')

{{-- Start by pulling this member profile --}}
@include('reports.member.partials.profile') 
<table class="ui table">
  	 <thead>
  	 	<tr>
	  	 	<th>{{ trans('general.date') }}</th>
	     	<th>{{ trans('loan.nature') }}</th>
			<th>{{ trans('loan.operation_type') }}</th>
			<th>{{ trans('loan.wording') }}</th>
			<th>{{ trans('loan.saving') }}</th>
	        <th>{{ trans('loan.withdrawal') }}</th>
	  	</tr>
   	 </thead>
 <tbody>
   @each ('reports.member.item_contribution_record', $member->contributions, 'contribution', 'members.no-items')
 </tbody>
</table>
