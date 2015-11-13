<?php $loan_to_repay = 0; ?>
<?php $interest = 0; ?>
<?php $monthly_fees = 0; ?>
<?php $tranches = 0; ?>
<tr class="green" style="border-top: 1px solid #fff;font-weight: 800;color: #fff;">
	<td colspan="3" >
		{!! trans('loan.contract_number') !!} : {!! $loan->loan_contract !!}
	</td>
	
	<td colspan="3" >
	   @if (!is_null($loan->getCautionneur1))	   	
		{!! trans('loan.cautionneur1') !!} : {!! $loan->getCautionneur1->first_name !!}
	   @endif
	</td>
    <td colspan="3" >
	   @if (!is_null($loan->getCautionneur2))	   	
		{!! trans('loan.cautionneur1') !!} : {!! $loan->getCautionneur2->first_name  !!}
	   @endif
	</td>
</tr>
<tr>
	<td>{!! $loan->letter_date !!}</td>
 	<td>{{  trans('loan.loan') }}</td>
	<td>{!! $loan->operation_type !!}</td>
	<td>{!! $loan->comment !!} </td>
	<td>{!! $loan->loan_to_repay !!} </td>
    <td>{!! $loan->interests !!} </td>
    <td>{!! $loan->monthly_fees !!} </td>
    <td>0</td>
</tr>
<?php $loan_to_repay += $loan->loan_to_repay; ?>
<?php $interest += $loan->interests; ?>
<?php $monthly_fees += $loan->monthly_fees; ?>
<?php $tranches += 0; ?>

@foreach ($loan->refunds as $refund)
<tr>
	<td>{!! $refund->created_at !!}</td>
 	<td>{{ trans('loan.refund') }}</td>
	<td>{{ trans('loan.refund') }}</td>
	<td>{{ $refund->wording }} </td>
    <td></td>
	<td></td>
    <td>{!! $refund->monthly_fees !!} </td>
    <td>{!! $refund->amount !!}</td>
</tr>
<?php $tranches += $refund->amount; ?>
@endforeach
<tr>
	<td colspan="4" style="text-align: center;font-weight: 600;">{{ trans('loan.movement_total') }}</td>
 	<td style="text-align: center;font-weight: 600;">{{ $loan_to_repay }}</td>
	<td style="text-align: center;font-weight: 600;">{{ $interest }}</td>
	<td style="text-align: center;font-weight: 600;">{{ $monthly_fees }} </td>
    <td style="text-align: center;font-weight: 600;">{{ $tranches }} </td>
</tr>
<tr style="border-bottom: 1px solid #000;">
	<td colspan="6"></td>
	<td class="orange" style="text-align: right;font-weight: 600;text-decoration: underline;">{{ trans('loan.loan_balance') }}</td>
	<td class="orange" style="text-align: center;font-weight: 600;text-decoration: underline;">{{ $loan_to_repay - $tranches }} </td>
</tr>

