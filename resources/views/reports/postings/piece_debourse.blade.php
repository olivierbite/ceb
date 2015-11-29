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
 </tbody>
</table>
<br/>
<table class="pure-table pure-table-bordered">
	  <thead>
  	 	<tr>
	  	 	<td>{{ trans('report.done_by') }}</td>
	     	<td>{{ trans('report.gerant') }}</td>
			<td>{{ trans('report.president') }}</td>
			<td>{{ trans('report.tresorien') }}</td>
			<td>{{ trans('report.controller') }}</td>
			<td>{{ trans('report.administrator') }}</td>
	  	</tr>
   	 </thead>
 </table>