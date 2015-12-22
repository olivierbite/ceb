@include('partials.landscapecss')
{{-- Start by pulling this member profile --}}
@if (!$loans->isEmpty())
	@include('reports.member.partials.profile',['member'=>$loans->last()->member]) 
@endif
<table class="pure-table pure-table-bordered">
<caption> {{ trans('reports.member_loan_records_file') }} </caption>
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

  @forelse ($loans as $loan)
  	@include('reports.member.item_loan_record', compact('loan'))
  @empty
  	@includ('members.no-items')
  @endforelse
 </tbody>
</table>
