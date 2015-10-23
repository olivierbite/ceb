@extends('reports.layouts.popup')
@section('content')
<div class="row">
	@include('members.search')
<br/>
<b>{{ trans('reports.report_range') }}</b>
<br/>
<div id="report_date_range_simple">
		<input type="radio" name="report_type" id="simple_radio" value="simple" checked="checked">
		{!! Form::select('report_date_range_simple', get_simple_date_ranges(),null, ['id'=>'report_date_range_simple']) !!}
</div>
<br/>
<input type="radio" name="report_type" id="complex_radio" value="complex">

    {!! Form::select('start_day', get_days(), date('d') , ['class' => 'fom-control start_day']) !!}
	{!! Form::select('start_month', get_months(), date('m'), ['class' => 'fom-control start_month']) !!}
	{!! Form::select('start_year', get_years(), date('m'), ['class' => 'fom-control start_year']) !!}

<b>-</b>
    {!! Form::select('end_day', get_days(), date('d') , ['class' => 'fom-control end_day']) !!}
	{!! Form::select('end_month', get_months(), date('m'), ['class' => 'fom-control end_month']) !!}
	{!! Form::select('end_year', get_years(), date('m'), ['class' => 'fom-control end_year']) !!}

<br/>
<br/>
<div>
	<b>{!! trans('reports.export_excel') !!}</b> :
	<input type="radio" name="export_excel" id="export_excel_yes" value="1"> {!! trans('general.yes') !!}
	<input type="radio" name="export_excel" id="export_excel_no" value="0" checked="checked"> {!! trans('general.no') !!}
	</div>
<br/>
<button class="btn btn-success btn-lg btn-block generate_report" type="submit" >{{ trans('report.submit') }}</button>
</div>

<script type="text/javascript" language="javascript">
$(document).ready(function()
{
	$(".generate_report").click(function(event)
	{
		event.preventDefault();

		var baseUrl = $(".report-name").val();
		var url = null;
		var export_excel = 0;

		if ($('#export_excel_yes').is(':checked'))
		{
			export_excel = 1;
		}

		if ($("#simple_radio").is(':checked'))
		{
			 url= '/'+baseUrl+'/'+$("#report_date_range_simple option:selected").val() +'/'+export_excel;
		}
		else
		{
			var start_date = $(".start_year").val()+'-'+$(".start_month").val()+'-'+$('.start_day').val();
			var end_date = $(".end_year").val()+'-'+$(".end_month").val()+'-'+$('.end_day').val();
			url = '/'+baseUrl+'/'+start_date + '/'+ end_date +'/'+ export_excel;
		}

		/**
		 * Only open new tab when it's not about downloading
		 */
		if(export_excel == 1)
		{
			window.location = url;
		}
		else
		{
			OpenInNewTab(url);
		}

	});
	
	$(".start_month, .start_day, .start_year, .end_month, .end_day, .end_year").click(function()
	{
		$("#complex_radio").attr('checked', 'checked');
	});
	
	$("#report_date_range_simple").click(function()
	{
		$("#simple_radio").attr('checked', 'checked');
	});
	
});
</script>
@stop