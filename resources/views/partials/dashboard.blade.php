@extends('layouts.default')

@section('content_title')
  {{ trans('navigations.dashboard') }}
@stop

@section('content')
<div class="row">

                <div class="col-lg-6">

                    <div class="box box-solid">
                        <div class="box-header">
                            <h3 class="box-title">Loan Summary</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-6">

                                    <div class="small-box bg-yellow">
                                        <div class="inner">
                                            <h3>50,000 Rwf</h3>
                                            <p>{{ trans('loan.ordinary_loans') }}</p>
                                        </div>
                                        <div class="icon"><i class="ion ion-edit"></i></div>
                                        <a class="small-box-footer" href="#">
                                            View detailed report <i class="fa fa-arrow-circle-right"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-sm-6">

                                    <div class="small-box bg-aqua">
                                        <div class="inner">
                                            <h3>300,000 Rwf</h3>
                                            <p>{{ trans('loan.special_loans') }}</p>
                                        </div>
                                        <div class="icon"><i class="ion ion-share"></i></div>
                                        <a class="small-box-footer" href="#">
                                            View detailed report <i class="fa fa-arrow-circle-right"></i>
                                        </a>
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-sm-6">

                                    <div class="small-box bg-red">
                                        <div class="inner">
                                            <h3>0.00 Rwf</h3>
                                            <p>{{ trans('loan.outstanding_loan') }}</p>
                                        </div>
                                        <div class="icon"><i class="ion ion-alert"></i></div>
                                        <a class="small-box-footer" href="">
                                            View detailed report <i class="fa fa-arrow-circle-right"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-sm-6">

                                    <div class="small-box bg-green">
                                        <div class="inner">
                                            <h3>101,550 Rwf</h3>
                                            <p>{{ trans('loan.full_paid_loan') }}</p>
                                        </div>
                                        <div class="icon"><i class="ion ion-heart"></i></div>
                                        <a class="small-box-footer" href="#">
                                            View Payments <i class="fa fa-arrow-circle-right"></i>
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
                            <h3 class="box-title">Ceb Summary</h3>
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
                                            View members <i class="fa fa-arrow-circle-right"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-sm-6">

                                    <div class="small-box bg-olive">
                                        <div class="inner">
                                            <h3>10</h3>
                                            <p>Institutions</p>
                                        </div>
                                        <div class="icon"><i class="ion ion-share"></i></div>
                                        <a class="small-box-footer" href="#">
                                            View full list<i class="fa fa-arrow-circle-right"></i>
                                        </a>
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-sm-6">

                                    <div class="small-box bg-orange">
                                        <div class="inner">
                                            <h3>150</h3>
                                            <p>Left members</p>
                                        </div>
                                        <div class="icon"><i class="ion ion-thumbsdown"></i></div>
                                        <a class="small-box-footer" href="#">
                                            View full list <i class="fa fa-arrow-circle-right"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-sm-6">

                                    <div class="small-box bg-blue">
                                        <div class="inner">
                                            <h3>1,350</h3>
                                            <p>Active members</p>
                                        </div>
                                        <div class="icon"><i class="ion ion-thumbsup"></i></div>
                                        <a class="small-box-footer" href="#">
                                            View members <i class="fa fa-arrow-circle-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
@stop