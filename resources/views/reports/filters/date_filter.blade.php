@extends('reports.layouts.popup')
@section('content')
<input type="hidden" class="report-name" value="{!! $reportUrl !!}">
<div class="row">
{{-- only show this search if it's a member reports --}}
@if ($filterOptions->member_search == true)
	@include('members.search')
	{!!Form::hidden('adhersion_id',null,['class'=>'adhersion_id']) !!}
@endif
<br/>
{{-- Only show this if the report require institition selection  --}}
@if ($filterOptions->show_institution == true)
<b>{{ trans('reports.select_institution') }}</b>	
	<br/>
	  {!! Form::select('institution', $institutions, null, ['class'=>'form-control']) !!}
	<br/>
@endif

{{-- Only show this if the report require loan status selection  --}}
@if ($filterOptions->show_loan_status == true)
<div>
	<b>{!! trans('reports.select_loan_status') !!} :</b> 
    {!! Form::select('loan_status', $loanStatuses, null , ['class' => 'loan_status']) !!}
 </div>
@endif	

{{-- Only show this if the report require accounts selection  --}}
@if ($filterOptions->show_accounts == true)
	<b>{{ trans('reports.select_account') }}</b>
	  {!! Form::select('account', $accounts,isset($accountId)?$accountId :null, ['class'=>'form-control'])!!}    
@endif

{{-- Only show this if the report require to show loan types selection  --}}
@if ($filterOptions->show_accounts == true)
  <b>{{ trans('reports.loan_type') }}</b>
   {!! Form::select('loan_type',$loanTypes,null,['class'=>'form-control','id'=>'loan_type'])!!}
@endif

{{-- Only show this if the report require to show dates selection  --}}
@if ($filterOptions->show_dates == true)
<b>{{ trans('reports.report_range') }}</b>
<br/>
<div id="report_date_range_simple">
	<input type="radio" name="report_type" id="simple_radio" value="simple" checked="checked">
		{!! Form::select('report_date_range_simple', get_simple_date_ranges(),null, ['id'=>'report_date_range_simple',]) !!}
</div>
<br/>
	<input type="radio" name="report_type" id="complex_radio" value="complex">
    {!! Form::select('start_day', get_days(), date('d') , ['class' => 'start_day']) !!}
	{!! Form::select('start_month', get_months(), date('m'), ['class' => 'start_month']) !!}
	{!! Form::select('start_year', get_years(), date('m'), ['class' => 'start_year']) !!}

<b>-</b>
    {!! Form::select('end_day', get_days(), date('d') , ['class' => 'end_day']) !!}
	{!! Form::select('end_month', get_months(), date('m'), ['class' => 'end_month']) !!}
	{!! Form::select('end_year', get_years(), date('m'), ['class' => 'end_year']) !!}

<br/>
<br/>
@endif

{{-- Only show this if the report require to show export options selection  --}}
@if ($filterOptions->show_exports == true)
<div>
	<b>{!! trans('reports.export_excel') !!} :</b> 
	<input type="radio" name="export_excel" id="export_excel_yes" value="1"> {!! trans('general.yes') !!}
	<input type="radio" name="export_excel" id="export_excel_no" value="0" checked="checked"> {!! trans('general.no') !!}
	</div>
<br/>
@endif

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
		var daterange    = null;
		var adhersion_id = 'none';
		if ($('#export_excel_yes').is(':checked'))
		{
			export_excel = 1;
		}
		

		if ($("#simple_radio").is(':checked'))
		{
			 daterange = $("#report_date_range_simple option:selected").val();
			 url= '/'+baseUrl+'/'+daterange +'/'+export_excel;
			 /** if we are going to look for loan status then change the url format */
			if($('.loan_status').length !== 0 ){
				var loan_status = $('.loan_status').val();
				url = '/'+baseUrl+'/'+daterange +'/'+loan_status+'/'+ export_excel;
			}
		}
		else
		{
			var start_date = $(".start_year").val()+'-'+$(".start_month").val()+'-'+$('.start_day').val();
			var end_date = $(".end_year").val()+'-'+$(".end_month").val()+'-'+$('.end_day').val();

			daterange = start_date + '/'+ end_date;
			url = '/'+baseUrl+'/'+ daterange+'/'+ export_excel;

			/** if we are going to look for loan status then change the url format */
			if($('.loan_status').length !== 0 ){
				var loan_status = $('.loan_status').val();
				url = '/'+baseUrl+'/'+daterange +'/'+loan_status+'/'+ export_excel;
			}
		}
        
		/** Add additinal parameters for the members routes */
		if(baseUrl.indexOf('members') !== -1)
		{
			/** USER MUST SELECT A MEMBER FOR THIS REPORT */
			if($('.adhersion_id').val() == '')
			{ swal.setDefaults({ confirmButtonColor: '#d9534f' });
				swal({
			            title:"Please select a member for this report",
			            type :"error",
			            html :true
			          });
				return exit;
			}

		    adhersion_id = $('.adhersion_id').val();
			url = url +'/'+adhersion_id;
		}

		if(baseUrl.indexOf('contract') !== -1)
		{
           
			url = baseUrl+'/'+adhersion_id+'/'+ export_excel;
		}

		/** OPEN  THE REPORT */
		OpenInNewTab(url);

	});
	
	$(".start_month, .start_day, .start_year, .end_month, .end_day, .end_year").click(function()
	{
		$("#complex_radio").attr('checked', 'checked');
	});
	
	$(".report_date_range_simple").click(function()
	{
		$("#simple_radio").attr('checked', 'checked');
	});
	
});
</script>
@stop