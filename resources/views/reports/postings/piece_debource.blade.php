<table class="pure-table pure-table-bordered">
<caption> {{ trans('reports.member_loan_records_file') }} </caption>
  	 <thead>
  	 	<tr>
	  	 	<th>{{ trans('account.account_number') }}</th>
	     	<th>{{ trans('account.account_entitled') }}</th>
			<th>{{ trans('account.debit') }}</th>
			<th>{{ trans('account.credit') }}</th>
	  	</tr>
   	 </thead>
 <tbody>
   @each('reports.member.item_piece_debourse', $loans, 'loan', 'members.no-items')
 </tbody>
</table>