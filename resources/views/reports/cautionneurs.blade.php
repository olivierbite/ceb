@if(!is_null($member->latestLoan()->getCautionneur1) || !is_null($member->latestLoan()->getCautionneur2))

<div dir="ltr" style="margin-left:-5.75pt;">
<table style="border:none;border-collapse:collapse" class="table table-bordered">
	<tbody>
		<tr style="height:0px">
			<th>
			Nr
			</th>
			<th>
			Noms
			</th>
			<th>
			Nr
			</th>
			<th>
			District
			</th>
			<th>
			Signature
			</th>
		</tr>
		@if (!is_null($member->latestLoan()->getCautionneur1) && $member->latestLoan()->getCautionneur1->exists)
	
		<tr style="height:0px">
			<td>
			Cautionneur></p>
			</td>
			<td>
			{!! $member->latestLoan()->getCautionneur1->first_name !!} {!! $member->latestLoan()->getCautionneur1->last_name !!}
			</td>
			<td>
			{!! $member->latestLoan()->getCautionneur1->member_nid !!}
			</td>
			<td>
			{!! $member->latestLoan()->getCautionneur1->district !!}
			</td>
			<td>
			 <img src="{{route('files.get', $member->latestLoan()->getCautionneur1->sighnature)}}" alt="{!! $member->latestLoan()->getCautionneur2->first_name !!}" style="width:40px;height:40px;" />
			</td>
		</tr>
				{{-- expr --}}
		@endif
	  @if (!is_null($member->latestLoan()->getCautionneur2) && $member->latestLoan()->getCautionneur2->exists)
	
		<tr style="height:0px">
			<td>
			Cautionneur1
			</td>
			<td>
			{!! $member->latestLoan()->getCautionneur2->first_name !!} {!! $member->latestLoan()->getCautionneur2->last_name !!}
			</td>
			<td>
			{!! $member->latestLoan()->getCautionneur2->member_nid !!}
			</td>
			<td>
			{!! $member->latestLoan()->getCautionneur2->district !!}
			</td>
			<td>
			 <img src="{{route('files.get', $member->latestLoan()->getCautionneur2->sighnature)}}" alt="{!! $member->latestLoan()->getCautionneur2->first_name !!}" style="width:40px;height:40px;" />
			</td>
		</tr>
				{{-- expr --}}
		@endif
	</tbody>
</table>
</div>
	{{-- expr --}}
@endif