@include('partials.landscapecss')

{{-- Start by pulling this member profile --}}
@if (!$contributions->isEmpty())
	@include('reports.member.partials.profile',['member'=>$contributions->last()->member])
@endif 
<table class="pure-table pure-table-bordered">
<caption> {{ trans('reports.member_contribution_file') }} {{ Request::segment(4).' Et '.Request::segment(5) }} </caption>
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
   <tr>
 	<th colspan="4">{{ trans('general.summary') }}</th>

	<th>{{ number_format($total_savings) }}</th>
	<th>{{ number_format($total_withdrawal) }}</th>
</tr>
 <tr>
 	<th colspan="4"></th>

	<th colspan="2">{{ number_format(abs($total_savings - $total_withdrawal)) }}</th>
</tr>
 </tbody>
</table>

<table class="pure-table pure-table-bordered">
  	 	<tr>
  	 	<td>
	  	 		{{ trans('report.beneficiaire') }} <br/>
				{!!  $contributions->first()->member->names !!}
	  	 	</td>
	  	 	<td>
	  	 		{{ trans('report.done_by') }} <br/>
	  	 		<?php $user = Sentry::getUser(); ?>
				{!!  $user->first_name !!} {!! $user->last_name !!}
	  	 	</td>
	     	<td>{{ trans('report.gerant') }} <br/>
				{!! (new Ceb\Models\Setting)->get('general.gerant') !!}
			</td>
			<td>{{ trans('report.president') }} <br/>
				{!! (new Ceb\Models\Setting)->get('general.president') !!}
				</td>
			<td>{{ trans('report.tresorien') }} <br/>
				{!! (new Ceb\Models\Setting)->get('general.tresorien') !!}
				</td>
			<td>{{ trans('report.controller') }} <br/>
				{!! (new Ceb\Models\Setting)->get('general.controller') !!}
				</td>
			<td>{{ trans('report.administrator') }} <br/>
				{!! (new Ceb\Models\Setting)->get('general.administrator') !!}
				</td>
	  	</tr>
 </table>
