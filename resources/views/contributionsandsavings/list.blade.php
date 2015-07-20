@extends('layouts.default')

@section('content_title')
  {{ trans('navigations.contributions') }}
  <script language="JavaScript">
function toggle(source) {
 checkboxes = document.getElementsByName('memberIds[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>
<style type="text/css">
  .header-container{
    background: rgba(0,0,0,0.1) !important;
    padding: 10px;
  }
</style>
@stop

@section('content')
  @include('contributionsandsavings.form',['institutions'=>$institutions,'institutionId'=>'institutionId'])

  <span role="separator" class="divider" style="padding:10px;"></span>
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
   @each ('contributionsandsavings.item', $members, 'member', 'contributionsandsavings.no-items')
 </tbody>
  </table>
@stop