@extends('layouts.default')

@section('content_title')
  {{ trans('navigations.dashboard') }}
@stop
@section('content')

<div class="row">
<div class="col-lg-6">
    <div class="box box-solid">
        <div class="box-header">
            <h3 class="box-title">{{ trans('loan.summary') }}</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-sm-6">

                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{!! number_format( round($dashboarddata['ordinary_loan'])) !!}</h3> 
                            <p>{{ trans('loan.ordinary_loans') }}</p>
                        </div>
                        <div class="icon"><i class="ion ion-edit"></i></div>
                        <a class="small-box-footer" href="#">
                            {{ trans('report.view_detailed_report') }} <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-sm-6">

                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{!! number_format(round($dashboarddata['special_loan'])) !!}</h3>
                            <p>{{ trans('loan.special_loans') }}</p>
                        </div>
                        <div class="icon"><i class="ion ion-share"></i></div>
                        <a class="small-box-footer" href="#">
                            {{ trans('report.view_detailed_report') }} <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
          <div class="row">
                <div class="col-sm-6">
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>{!! number_format(round($dashboarddata['outstanding_loan']))!!}</h3>
                            <p>{{ trans('loan.outstanding_loan') }}</p>
                        </div>
                        <div class="icon"><i class="ion ion-alert"></i></div>
                        <a class="small-box-footer" href="">
                            {{ trans('report.view_detailed_report') }} <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-sm-6">

                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{!! number_format( $dashboarddata['refunded_amount']) !!}</h3>
                            <p>{{ trans('loan.full_paid_loan') }}</p>
                        </div>
                        <div class="icon"><i class="ion ion-heart"></i></div>
                        <a class="small-box-footer" href="#">
                            {{ trans('general.view_payments') }} <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="col-lg-6">
    <div class="box box-solid">
        <div class="box-header">
            <h3 class="box-title">{{ trans('general.ceb_summary') }}</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-sm-6">

                    <div class="small-box bg-purple">
                        <div class="inner">
                            <h3>{!! $membersCount !!}</h3>
                            <p>{{ trans('member.count_of_members') }}</p>
                        </div>
                        <div class="icon"><i class="ion ion-edit"></i></div>
                        <a class="small-box-footer" href="{{ route('members.index') }}">
                            {{ trans('member.view_members') }} <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="small-box bg-olive">
                        <div class="inner">
                            <h3>{!! $dashboarddata['institutions'] !!}</h3>
                            <p>{{ trans('navigation.institution') }}</p>
                        </div>
                        <div class="icon"><i class="ion ion-share"></i></div>
                        <a class="small-box-footer" href="{{ route('settings.institution.index') }}">
                            {{ trans('general.view_full_lists') }} <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="small-box bg-orange">
                        <div class="inner">
                            <h3>{!! $dashboarddata['left_members_count'] !!}</h3>
                            <p>{{ trans('member.left_members') }}</p>
                        </div>
                        <div class="icon"><i class="ion ion-thumbsdown"></i></div>
                        <a class="small-box-footer" href="#">
                            {{ trans('general.view_full_lists') }}  <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="small-box bg-blue">
                        <div class="inner">
                            <h3>{!! $dashboarddata['active_members_count'] !!}</h3>
                            <p>{{ trans('member.active_members') }}</p>
                        </div>
                        <div class="icon"><i class="ion ion-thumbsup"></i></div>
                        <a class="small-box-footer" href="#">
                            {{ trans('member.view_members') }} <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@stop