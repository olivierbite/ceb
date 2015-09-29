<a class="popdown col-xs-5 col-md-5 btn btn-success btn-box" href="{!!route('members.attornies',['memberId' => $member->id]) !!}">
<i class="fa fa-list-ol"></i>
  {{ trans('member.member_attornes') }}
</a>

<a class="popdown col-xs-5 col-md-5 btn btn-success btn-box" href="{{ route('attornies.create') }}?member={!! isset($member->id)?$member->id:null !!}">
 <i class="fa fa-plus"></i> 
 {{ trans('member.add_attornies') }}
</a>

@if(count($member->contributions) > 0)

<a 	class="col-xs-5 col-md-5 btn btn-success btn-box"
	href="{{ route('reports.contracts.saving',['memberId' => $member->id]) }}"
	target="_blank"
>
	<i class="fa fa-newspaper-o"></i>
	{{ trans('member.contract_saving') }}
</a>

@endif

@if(count($member->loans) > 0)

<a 	class="col-xs-5 col-md-5 btn btn-success btn-box"
	href="{{ route('reports.contracts.loan',['memberId' => $member->id]) }}"
	target="_blank"
><i class="fa fa-newspaper-o"></i>
{{ trans('member.contract_loan') }}
</a>

@endif

@if($member->hasActiveLoan())

<a 	class="col-xs-5 col-md-5 btn btn-warning btn-box"
	href="{{ route('members.refund',['memberId' => $member->id]) }}"
	target="_blank"
>
<i class="fa fa-refresh"></i>
	{{ trans('member.refund_loan') }}
</a>

@endif

<a 	class="col-xs-5 col-md-5 btn btn-info btn-box"
	href="{{ route('members.contribute',['memberId' => $member->id]) }}"
		target="_blank"
>
<i class="fa fa-save"></i>
{{ trans('member.contribute') }}
</a>

<a 	class="popdown col-xs-5 col-md-5 btn btn-danger btn-box"
	href="{{ route('members.transacts',['memberId' => $member->id]) }}"
>
<i class="fa fa-money"></i>
{{ trans('member.do_a_transaction') }}
</a>
