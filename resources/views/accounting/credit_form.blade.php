<div class="row credit-accounts">
<label>{{ trans('loan.credit_account') }}</label>
<div class="form-group" >
    <div class="col-xs-6">
    <label>{{ trans('accounting.debit_account') }}</label>
    </div>
    <div class="col-xs-4">
    <label>{{ trans('accounting.amount') }}</label>
    </div>
     <div class="col-xs-2">
     </div>
</div>
        @if(count($creditAccounts) > 0)
        @foreach($creditAccounts as $accountId => $amount)
            @if($amount<1)
             {{-- Since amount is 0 then we have nothing to do here, continue to the next loop element --}}
             <?php continue;?>
            @endif
            @include('accounting.credit',['accountId'=>$accountId,'amount'=>$amount])
        @endforeach
        @else
            @include('accounting.credit',['accountId'=>2,'amount'=>isset($loanInputs['loan_to_repay'])?$loanInputs['loan_to_repay']:0])
        @endif
		<div class="btn btn-success add-button">
			+
		</div>
</div>