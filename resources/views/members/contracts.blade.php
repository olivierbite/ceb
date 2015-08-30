<div class="containter row">
<a 	class="btn btn-success"
	href="{{ route('reports.contracts.saving',['memberId' => $member->id]) }}"
	target="_blank"
>
{{ trans('member.contract_saving') }}</a>
</div>

<a 	class="btn btn-success"
	href="{{ route('reports.contracts.loan',['memberId' => $member->id]) }}"
	target="_blank"
>
{{ trans('member.contract_loan') }}</a>
</div>