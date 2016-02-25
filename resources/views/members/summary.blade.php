<div class="small-box bg-green">
    <div class="inner">
        <h3>{!! number_format($member->totalContributions(), 0, "", ",") !!} Rwf</h3>
        <p>{{ trans('member.total_contribution') }}</p>
    </div>
    <div class="icon"><i class="ion ion-heart"></i></div>
</div>

<div class="small-box bg-red">
    <div class="inner">
        <h3>{!! number_format($member->Loan_balance, 0, null, ",") !!} Rwf</h3> 
        <p>{{ trans('member.loan_as_of_today') }}</p>
    </div>
    <div class="icon"><i class="ion ion-edit"></i></div>
</div>

<div class="small-box bg-yellow">
    <div class="inner">
        <h3>{!! number_format($member->loan_montly_fee, 0, null, ",") !!} Rwf</h3> 
        <p>{{ trans('member.active_loan_monthly_fees_payments') }}</p>
    </div>
    <div class="icon"><i class="ion ion-edit"></i></div>
</div>

<div class="small-box bg-olive">
    <div class="inner">
        <h3>{!! $member->remainingInstallment() !!}</h3>
        <p>{{ trans('member.remaining_installments') }}</p>
    </div>
    <div class="icon"><i class="ion ion-share"></i></div>
</div>

<div class="small-box bg-black">
    <div class="inner">
        <h3>{!! number_format($member->caution_amount - $member->caution_refunded) !!}</h3>
        <p>{{ trans('member.total_cautions_amount') }}</p>
    </div>
    <div class="icon"><i class="ion ion-heart"></i></div>
</div>
