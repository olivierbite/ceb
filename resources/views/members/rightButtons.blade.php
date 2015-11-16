<a class="popdown col-xs-5 col-md-5 btn btn-info btn-box windows" href="{!!route('members.attornies',['memberId' => $member->id]) !!}">
<i class="fa fa-list-ol"></i>
  {{ trans('member.member_attornes') }}
</a>

<a class="popdown col-xs-5 col-md-5 btn btn-info btn-box windows" href="{{ route('attornies.create') }}?member={!! isset($member->id)?$member->id:null !!}">
 <i class="fa fa-plus"></i> 
 {{ trans('member.add_attornies') }}
</a>

@if(count($member->contributions) > 0)

<a 	class="col-xs-5 col-md-5 btn btn-success btn-box green"
	href="{{ route('reports.members.contracts.saving',['memberId' => $member->id]) }}"
	target="_blank"
>
	<i class="fa fa-newspaper-o"></i>
	{{ trans('member.contract_saving') }}
</a>
@endif

@if(count($member->loans) > 0)
<a 	class="col-xs-5 col-md-5 btn btn-success btn-box green"
	href="{{ route('reports.members.contracts.loan',['memberId' => $member->id]) }}"
	target="_blank"
>
<i class="fa fa-newspaper-o"></i>
{{ trans('member.contract_loan') }}
</a>
<a 	class="col-xs-5 col-md-5 btn btn-inverse btn-box dark"
	href="{{ route('members.loanrecords',['memberId' => $member->adhersion_id]) }}"
	target="_blank"
><i class="fa fa-newspaper-o"></i>
{{ trans('member.loan_records') }}
</a>
@endif
@if($member->hasActiveLoan())
<a 	class="col-xs-5 col-md-5 btn btn-warning btn-box warning"
	href="{{ route('members.refund',['memberId' => $member->id]) }}"
>
<i class="fa fa-refresh"></i>
	{{ trans('member.refund_loan') }}
</a>

@endif
<a 	class="col-xs-5 col-md-5 btn btn-inverse btn-box dark"
	href="{{ route('members.contributions',['memberId' => $member->adhersion_id]) }}"
	target="_blank"
><i class="fa fa-newspaper-o"></i>
{{ trans('member.contributions') }}
</a>

<a 	class="popdown col-xs-5 col-md-5 btn btn-warning  btn-box orange"
	href="{{ route('members.transacts',['memberId' => $member->id]) }}"
>
<i class="fa fa-money"></i>
{{ trans('member.do_a_transaction') }}
</a>
<a 	class="popdown btn btn-warning col-xs-12 col-md-12"
	href="{{ route('members.cautions.actives',['memberId' => $member->id]) }}"
>
<i class="fa fa-users"></i>
{{ trans('member.view_current_cautionneurs') }}
</a>
<a 	class="popdown btn btn-primary col-xs-12 col-md-12"
	href="{{ route('members.cautioned.actives',['memberId' => $member->id]) }}"
>
<i class="fa fa-users"></i>
{{ trans('member.view_member_cautioned_by_me') }}
</a>

