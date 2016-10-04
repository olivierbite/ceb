<div class="col-lg-12">
    <div class="box box-solid">
        <div class="box-header">
            <h3 class="box-title">{!! ucfirst(trans('loans.emergency_loan_details')) !!}</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-sm-3">

                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{!! number_format($balance = $emergencyLoan->emergency_balance) !!}</h3> 
                        </div>
                        <div class="icon"><i class="ion ion-edit"></i></div>
                        <h4 class="small-box-footer" href="#">
                           {{ trans('loans.emergency_loan_balance') }}
                        </h4>
                    </div>
                </div>

                <div class="col-sm-3">

                    <div class="small-box bg-blue">
                        <div class="inner">
                            <h3>{!! number_format($monthly_fees = $emergencyLoan->monthly_fees) !!}</h3>
                        </div>
                        <div class="icon"><i class="ion ion-share"></i></div>
                       <h4 class="small-box-footer" href="#">
                           {{ trans('loans.emergency_loan_monthly_fees') }}
                        </h4>
                    </div>
                </div>
                 <div class="col-sm-3">
                    <div class="small-box bg-olive">
                        <div class="inner">
                            <h3>{!! number_format($emergencyLoan->emergency_refund) !!}</h3>
                        </div>
                        <div class="icon"><i class="ion ion-share"></i></div>
                       <h4 class="small-box-footer" href="#">
                           {{ trans('loans.emergency_loan_refund') }}
                        </h4>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>{!! ($monthly_fees > 0) ? abs($balance/$monthly_fees) : 0 !!}</h3>
                        </div>
                        <div class="icon"><i class="ion ion-share"></i></div>
                       <h5 class="small-box-footer" href="#">
                           {{ trans('loans.emergency_loan_remaining_tranches') }}
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>