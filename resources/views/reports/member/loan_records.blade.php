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
   	<?php $loan_to_repay = 0; ?>
	<?php $interest = 0; ?>
	<?php $monthly_fees = 0; ?>

  <?php $first_loan = $loans->first()->id; ?>
  @forelse ($loans as $loan)

  	{{-- HEADER TABLE ONLY SHOW HEADERS FOR ORDINARY LOAN--}}
  	@if ((strpos($loan->operation_type,'ordinary_loan') !== FALSE || strpos($loan->operation_type,'emergency_loan') !== FALSE) && $loan->is_regulation == false)
  		{{-- SUMMARY TABLE --}}
		@if ($loan->id !== $first_loan)
			@include('reports.member.item_loan_record_summary')
			   	<?php $loan_to_repay = 0; ?>
				<?php $interest = 0; ?>
				<?php $monthly_fees = 0; ?>
		@endif

  		<?php $tranches = 0; ?>
		@include('reports.member.item_loan_record_header')
  	@endif

	<tr>
		<td>{!! $loan->letter_date->format('Y-m-d') !!}</td>
	 	<td>{{  trans('loan.loan') }}</td>
		<td>{!! trans('loans.'.$loan->operation_type)  !!}</td>
		<td>{!! $loan->comment !!} </td>
		<td>{!! number_format((int) $loan->loan_to_repay) !!} </td>
	    <td>{!! number_format((int) $loan->interests) !!} </td>
	    <td>{!! number_format((int) $loan->monthly_fees) !!} </td>
	    <td>0</td>
	</tr>

  	<?php $loan_to_repay += $loan->loan_to_repay; ?>
	<?php $interest += $loan->interests; ?>
	<?php $monthly_fees += $loan->monthly_fees; ?>

  	{{-- REFUND TABLE  --}}
	@foreach ($loan->refunds as $refund)
	@include('reports.member.item_loan_record_refund')
		<?php $tranches += $refund->amount; ?>
	@endforeach
  @empty
  	@include('members.no-items')
  @endforelse
  <?php try{?>
   @include('reports.member.item_loan_record_summary')
   <?php }catch(\Exception $e){

   	} ?>
 </tbody>
</table>
