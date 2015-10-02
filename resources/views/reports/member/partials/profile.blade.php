 <table class="ui table" style="width:40%;padding:0;line-height: 9; ">
  	 	<tr>
	  	 	<th>{{ trans('member.adhersion_number') }}</th>
	     	<td>{{ $member->adhersion_id }}</td>
	  	</tr>
	  	<tr>
	  	 	<th>{{ trans('member.names') }}</th>
	     	<td>{{ $member->first_name.'  '.$member->last_name }} </td>
	  	</tr>
	  	<tr>
	  	 	<th>{{ trans('member.institution') }}</th>
	     	<td>{{ $member->institution?$member->institution->name:null }}</td>
	  	</tr>
	  	<tr>
	  	 	<th>{{ trans('member.adhersion_date') }}</th>
	     	<td>{{ $member->created_at }}</td>
	  	</tr>
  </table>