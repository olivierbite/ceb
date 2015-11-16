@extends('layouts.default')

@section('content_title')
  {{ trans('navigations.refunds') }}
  <script language="JavaScript">
function toggle(source) {
 checkboxes = document.getElementsByName('memberIds[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>
@stop
@section('content')

{!! Form::open(['route'=>'refunds.complete']) !!}
  @include('refunds.form',['institutionId'=>'institutionId'])

     {{-- only show this if we have members ... --}}
  @if (count($members) > 0)
  {!! Form::open(array('route'=>'refunds.complete','method'=>'POST')) !!}
  <label>{{ trans('refund.libelle') }}</label>
  {!! Form::text('wording', 
             (!empty($wording)) ? $wording : trans('refund.refund_for_the_month_of').' '.$month.date('/Y'),
              ['class'=>'form-control','placeholder'=>'refund for this month ....']) !!}
  @include('contributionsandsavings.buttons',['cancelRoute'=>'refunds.cancel'])
  {!! Form::close() !!}
  <table class="table table-bordered">
  	 <thead>
  	 	<tr>
        <th> <input type="checkbox" onClick="toggle(this)" checked/> </th>
        <th> {{ trans('member.adhersion_number') }}</th>
        <th> {{ trans('member.member') }}</th>
        <th> {{ trans('member.institution') }}</th>
        <th> {{ trans('member.employee_id') }}</th>
        <th> {{ trans('member.monthly_fee') }}</th>
  	 		<th><i class="fa fa-gear"></i></th>
  	 	</tr>
   	 </thead>
 <tbody>
   @each ('refunds.item', $members, 'member', 'refunds.no-items')
 </tbody>
</table>
  @endif
 {!! Form::close() !!}
@stop
