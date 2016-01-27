<table class="pure-table pure-table-bordered" style="width:30%;float: left ">
  	 	<tr>
	  	 	<th> {!! $labels->top_left_upper !!}</th>
	     	<td> {!! $labels->top_left_upper_value !!}</td>
	  	</tr>
	  	<tr>
	  	 	<th> {!! $labels->top_left_under !!}</th>
	     	<td> {!! $labels->top_left_under_value !!} </td>
	  	</tr>
  </table>
  <table class="pure-table pure-table-bordered" style="width:30%;float: right ">
  	 	<tr>
	  	 	<th> {!! $labels->top_right_upper !!}</th>
	     	<td> {!! $labels->top_right_upper_value !!}</td>
	  	</tr>
	  	<tr>
	  	 	<th> {!! $labels->top_right_under !!}</th>
	     	<td> {!! $labels->top_right_under_value !!} </td>
	  	</tr>
  </table>
<table class="pure-table pure-table-bordered">
<caption> {!! $labels->title !!} </caption>
  	 <thead>
  	 	<tr>
	  	 	<th>{{ trans('account.account_number') }}</th>
	     	<th>{{ trans('account.account_entitled') }}</th>
			<th>{{ trans('account.debit') }}</th>
			<th>{{ trans('account.credit') }}</th>
	  	</tr>
   	 </thead>
 <tbody>

   @each('reports.member.item_piece_debourse', $postings, 'posting', 'members.no-items')
	
	@if (count($postings) > 0)
   	<tr>
	  	 	<th colspan="2">{!!  $postings->first()->wording !!}</th>
			<th>{!! number_format(abs($postings->where('transaction_type','debit')->sum('amount'))) !!}</th>
			<th>{!! number_format(abs($postings->where('transaction_type','credit')->sum('amount')))!!}</th>
	  	</tr>
	 @endif
 </tbody>
</table>
<br/>
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