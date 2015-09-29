@if(count($member->contributions) > 0)
<div class="row">
<a 	class="col-xs-12 col-sm-12 col-md-12 col-lg-12 btn btn-lg btn-success"
	href="{{ route('reports.contracts.saving',['memberId' => $member->id]) }}"
	target="_blank"
>
{{ trans('member.contract_saving') }}</a>
</div>
@endif

@if(count($member->loans) > 0)
<div class="row">
<a 	class="col-xs-12 col-sm-12 col-md-12 col-lg-12 btn btn-lg btn-success"
	href="{{ route('reports.contracts.loan',['memberId' => $member->id]) }}"
	target="_blank"
>
{{ trans('member.contract_loan') }}</a>
</div>
@endif

@if($member->hasActiveLoan())
<div class="row">
<a 	class="col-xs-12 col-sm-12 col-md-12 col-lg-12 btn btn-lg btn-warning"
	href="{{ route('members.refund',['memberId' => $member->id]) }}"
	target="_blank"
>
{{ trans('member.refund_loan') }}</a>
</div>
@endif
<div class="row">
<a 	class="col-xs-12 col-sm-12 col-md-12 col-lg-12 btn btn-lg btn-info"
	href="{{ route('members.contribute',['memberId' => $member->id]) }}"
	target="_blank"
>
{{ trans('member.contribute') }}</a>
</div>

<a 	class="popdown col-xs-12 col-sm-12 col-md-12 col-lg-12 btn btn-lg btn-danger"
	href="{{ route('members.transacts',['memberId' => $member->id]) }}"
>
{{ trans('member.do_a_transaction') }}</a>
</div>