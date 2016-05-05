<div class="row">
<div class="col-sm-6"><div class="small-box bg-green">
    <div class="inner">
        <h4>{!! number_format($member->totalContributions(), 0, "", ",") !!} Rwf</h4>
    </div>
    <div class="icon"><i class="ion ion-heart"></i></div>
        <h5 class="small-box-footer">{{ trans('member.total_contribution') }}</h5>
</div>
</div>
<div class="col-sm-6">
<div class="small-box bg-red">
    <div class="inner">
         <?php $loanBalance = $member->Loan_balance; ?>
        <h4>{!! number_format($loanBalance, 0, null, ",") !!} Rwf</h4> 
    </div>
    <div class="icon"><i class="ion ion-edit"></i></div>
        <h5 class="small-box-footer">{{ trans('member.loan_as_of_today') }}</h5>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-6">
<div class="small-box bg-yellow">
    <div class="inner">
        <?php $loanMontlyFee = $member->loan_montly_fee; ?>
        <h4>{!! number_format($loanMontlyFee, 0, null, ",") !!} Rwf</h4> 
    </div>
    <div class="icon"><i class="ion ion-edit"></i></div>
        <h5 class="small-box-footer">{{ trans('member.active_loan_monthly_fees_payments') }}</h5>
</div>
</div>

<div class="col-sm-6">
<div class="small-box bg-olive">
    <div class="inner">

    </div>
    <div class="icon"><i class="ion ion-share"></i></div>
        <h5 class="small-box-footer">{{ trans('member.remaining_installments') }}</h5>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="small-box bg-black">
    <div class="inner">
        <h4>{!! number_format($member->caution_amount - $member->caution_refunded) !!}</h4>
    </div>
    <div class="icon"><i class="ion ion-heart"></i></div>
        <h5 class="small-box-footer">{{ trans('member.total_cautions_amount') }}</h5>
</div>
</div>
</div>