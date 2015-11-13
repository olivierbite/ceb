@include('partials.landscapecss')

{{-- Start by pulling this member profile --}}
@if (!$contributions->isEmpty())
	@include('reports.member.partials.profile',['member'=>$contributions->last()->member])
@endif 
<table class="pure-table pure-table-bordered">
<caption> {{ trans('reports.member_contribution_file') }} </caption>
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
   @each ('reports.member.item_contribution_record', $contributions, 'contribution', 'members.no-items')
 </tbody>
</table>
