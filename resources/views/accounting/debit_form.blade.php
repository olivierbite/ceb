<div class="row debit-accounts">
<label>{{ trans('loan.debit_account') }}</label>
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
        @if(count($debitAccounts) > 0)
            @foreach($debitAccounts as $accountId => $amount)
                @if($amount < 1)
                {{-- We have nothing to do here, Just go to the next loop element --}}
                <?php continue;?>
                @endif
                @include('accounting.debit',['accountId' => $accountId,'amount'=>$amount])
            @endforeach
        @else
            @include('accounting.debit',['accountId' => 1,'amount'=> isset($loanInputs['loan_to_repay'])?$loanInputs['loan_to_repay']:0])
        @endif
		<div class="btn btn-success add-button">
			+
		</div>
</div>