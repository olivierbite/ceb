<tr>
	<td colspan="4" style="text-align: center;font-weight: 600;">{{ trans('loan.movement_total') }}</td>
 	<td style="text-align: center;font-weight: 600;">{{ number_format((int) $loan_to_repay) }}</td>
	<td style="text-align: center;font-weight: 600;">{{ number_format((int) $interest) }}</td>
	<td style="text-align: center;font-weight: 600;">{{ number_format((int) $monthly_fees) }} </td>
    <td style="text-align: center;font-weight: 600;">{{ number_format((int) $tranches) }} </td>
</tr>
<tr style="border-bottom: 1px solid #000;">
	<td colspan="6"></td>
	<td class="orange" style="text-align: center;font-weight: 600;text-decoration: underline;">{{ trans('loan.loan_balance') }}</td>
	<td class="orange" style="text-align: center;font-weight: 600;text-decoration: underline;">
	{{ number_format((int) $loan_to_repay - $tranches) }} </td>
</tr>
