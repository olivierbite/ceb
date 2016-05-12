@include('partials.landscapecss')
{{-- Start by pulling this member profile --}}
@if (!empty($loans))
    <?php $member = (new \Ceb\Models\User)->findByAdhersion($loans[0]->adhersion_id) ;?>
	@include('reports.member.partials.profile',['member'=>$member]) 
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
   	<?php	$loan_to_repay =0; ?>
	<?php	$interest 	 =0; ?>
	<?php	$monthly_fees  =0; ?>
	<?php	$tranches  =0; ?>
	<?php   $loan_contract = 0 ;?>

  <?php $first_loan = $loans[0]->id; ?>
  @foreach ($loans as $loan)

  	{{-- HEADER TABLE ONLY SHOW HEADERS FOR ORDINARY LOAN--}}
  	@if ((strpos($loan->operation_type,'ordinary_loan') !== FALSE || strpos($loan->operation_type,'emergency_loan') !== FALSE) && $loan->is_regulation == false)
  		{{-- SUMMARY TABLE --}}
		@if ($loan->id !== $first_loan)
			@include('reports.member.item_loan_record_summary')
			     	<?php	$loan_to_repay =0; ?>
					<?php	$interest 	 =0; ?>
					<?php	$monthly_fees  =0; ?>
					<?php	$tranches  =0; ?>
		@endif

  		<?php $tranches = 0; ?>
		@include('reports.member.item_loan_record_header')
  	@endif
	
	<tr>
		<td>{!! date('Y-m-d',strtotime($loan->created_at)) !!}</td>
	 	<td>{!! trans('loan.'.trim($loan->record_type)) !!}</td>
		<td>{!! trans('loan.'.$loan->operation_type)  !!}</td>
		<td>{!! $loan->wording !!} </td>
		<td>{!! ($loan->operation_type == 'installments')?'': number_format((int) $loan->loan_amount) !!} </td>
	    <td>{!! number_format((int) $loan->interests) !!} </td>
	    <td>{!! number_format((int) $loan->monthly_fees) !!} </td>
	    <td>{!! number_format((int) $loan->tranches) !!} </td>
	</tr>
  	<?php $loan_to_repay += $loan->loan_amount; ?>
	<?php $interest 	 += $loan->interests; ?>
	<?php $monthly_fees  += $loan->monthly_fees; ?>
	<?php $tranches  += $loan->tranches; ?>
	

 
  @endforeach

   @include('reports.member.item_loan_record_summary')
   
 </tbody>
</table>
