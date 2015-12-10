 <table class="pure-table pure-table-bordered" style="width:40%; ">
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
	     	<td>{{ $member->created_at->format('Y-m-d') }}</td>
	  	</tr>
  </table>