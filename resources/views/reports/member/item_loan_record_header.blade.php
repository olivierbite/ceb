<tr class="green" style="border-top: 1px solid #fff;font-weight: 800;color: green">
	<td colspan="3" >
		{!! trans('loan.contract_number') !!} : {!! $loan->loan_contract !!}
	</td>
	
	<td colspan="2" >  	
		{!! trans('loan.cautionneur1') !!} 
		  : {!! (empty(\Ceb\Models\Loan::find($loan->id)->cautionneur1) == false )?\Ceb\Models\Loan::find($loan->id)->cautionneur1->cautionneur_adhresion_id:null !!}
	</td>
    <td colspan="4" >   	
		{!! trans('loan.cautionneur2') !!} : 
		{!! (empty(\Ceb\Models\Loan::find($loan->id)->cautionneur2)==false )?\Ceb\Models\Loan::find($loan->id)->cautionneur2->cautionneur_adhresion_id:null;  !!}
	</td>
</tr>