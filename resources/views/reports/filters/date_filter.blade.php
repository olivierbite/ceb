@extends('reports.layouts.popup')
@section('content')
<div class="row">
	@include('members.search')
<br/>
	
<b>{{ trans('reports.from') }}</b>
    {!! Form::selectRange('from_date', 01, 31, date('d') , ['class' => 'fom-control']) !!}
	{!! Form::selectMonth('from_month', date('m')-1, ['class' => 'fom-control']) !!}
	{!! Form::selectYear('from_year', date('Y')-4, date('Y'), date('Y'), ['class' => 'fom-control']) !!}

<b>-</b>
	{!! Form::selectRange('to_date', 01, 31, date('d'), ['class' => 'fom-control']) !!}
	{!! Form::selectMonth('to_month', date('m'), ['class' => 'fom-control']) !!}
	{!! Form::selectYear('to_year', date('Y')-4, date('Y'), date('Y'), ['class' => 'fom-control']) !!}

<br/>
<br/>
<div>
	<b>{!! trans('reports.export_excel') !!}</b> :
	<input type="radio" name="export_excel" id="export_excel_yes" value="1"> {!! trans('general.yes') !!}
	<input type="radio" name="export_excel" id="export_excel_no" value="0" checked="checked"> {!! trans('general.no') !!}
	</div>
<br/>
<button class="btn btn-success btn-lg btn-block submit-member-transaction-button" type="submit">{{ trans('report.submit') }}</button>
</div>
@stop