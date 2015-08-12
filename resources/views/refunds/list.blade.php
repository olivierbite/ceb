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
  @include('refunds.form',['institutionId'=>'institutionId'])
  <table class="ui table">
  	 <thead>
  	 	<tr>
        <th> <input type="checkbox" onClick="toggle(this)" checked/> </th>
        <th> {{ trans('member.adhersion_number') }}</th>
        <th> {{ trans('member.names') }}</th>
        <th> {{ trans('member.institution') }}</th>
        <th> {{ trans('member.monthly_fee') }}</th>
  	 		<th><i class="fa fa-gear"></i></th>
  	 	</tr>
   	 </thead>
 <tbody>
   @each ('refunds.item', $members, 'member', 'refunds.no-items')
 </tbody>
  </table>
@stop
@section('content_footer')
    @include('partials.buttons',['completeRoute'=>'refunds.complete','cancelRoute'=>'refunds.cancel'])
@stop