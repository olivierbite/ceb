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
@stop

@section('content')


  @include('contributionsandsavings.form',['institutions'=>$institutions,'institutionId'=>'institutionId'])

  @include('contributionsandsavings.buttons')
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