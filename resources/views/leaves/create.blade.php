@extends('layouts.popdown')
@section('content')
<div class="row">
    <div class="col-md-12 col-md-offset-0">

        <h2>{{ trans('leave.Apply_for_leave_here') }}</h2>
        {!!  Form::open(array('route' => array('leaves.store'), 'method' => 'post')) !!}
        @foreach ($errors->all() as $message)
        {!! $message!!}
        @endforeach
        <div class="form-group">
            {!! Form::label('start',trans('leave.Start_Date'))!!}
            {!! Form::select('start_day', get_days(), date('d') , ['class' => 'start_day']) !!}
            {!! Form::select('start_month', get_months(), date('m'), ['class' => 'start_month']) !!}
            {!! Form::select('start_year', get_years(), date('y'), ['class' => 'start_year']) !!}

        <b>{{ trans('leave.to') }}</b>
            {!! Form::select('end_day', get_days(), date('d') , ['class' => 'end_day']) !!}
            {!! Form::select('end_month', get_months(), date('m'), ['class' => 'end_month']) !!}
            {!! Form::select('end_year', [date('y')+1=>date('y')+1] + get_years(), date('y'), ['class' => 'end_year']) !!}

         <br/>        
        </div>
        {!! Form::submit('Apply', array('class' => 'btn btn-primary'))!!}
        {!!  Form::close() !!}
    </div>
</div>
@stop