<?php $member = $caution->member; ?>
<tr>
	<td>{!! $member->adhersion_id!!}</td>
	<td>
		<img class="direct-chat-img" src="{{route('files.get', $member->photo)}}" align="left">
		<strong>{!! $member->names !!} </strong> <br/>
		<small><strong>{{trans('member.nid')}}:</strong></small><small>{!! $member->member_nid !!}</small>
	</td>
	<td>{!! $member->institution_name !!}</td>
	<td>{!! $member->service !!}</td>
	<td>{!! $amount = (int) $caution->amount !!}</td>
	<td>{!! $refunded_amount = (int) $caution->refunded_amount !!}</td>
	<td>{!! $amount - $refunded_amount!!}</td>
</tr>