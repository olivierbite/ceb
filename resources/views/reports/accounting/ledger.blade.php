@if (!$postings->isEmpty())
<?php $account = $postings->first()->account; ?>

<strong>{{ trans('account.account_number') }} : </strong>{!! $account->account_number !!}, 
<strong>{{ trans('account.titled') }} :</strong> {!! $account->entitled !!}, 
<strong>{{ trans('account.account_nature') }} :</strong> {!! $account->account_nature !!}, 
<strong>{{ trans('general.between') }} :</strong> {!! request()->segment(4) !!} {{ trans('general.and') }} {!! request()->segment(5) !!}
<hr/>
<table class="pure-table pure-table-bordered">
<caption> {{ trans('reports.ledger') }} </caption>
	<thead>
		<tr>
			<th>{{ trans('account.date') }}</th>
			<th>{{ trans('account.wording') }}</th>
			<th>{{ trans('account.debit') }}</th>
			<th>{{ trans('account.credit') }}</th>
		</tr>
	</thead>
	<tbody>
	@forelse ($postings as $posting)
	<tr>
		<td>{!! $posting->created_at->format('Y-m-d') !!}</td>
		<td>{!! $posting->wording !!}</td>
		<td>{!! number_format(abs($posting->debit_amount)) !!}</td>
		<td>{!! number_format(abs($posting->credit_amount)) !!}</td>
	</tr>
	@empty
		{{-- empty expr --}}
	@endforelse
	<tr>
			<th colspan="2"><b>{{ trans('posting.wording') }}:</b> {!! $postings->first()->wording !!}</th>
			<th>{!! number_format(abs($postings->sum('amount'))) !!}</th>
			<th>{!! number_format(abs($postings->sum('amount'))) !!}</th>
		</tr>
	</tbody>
</table>
@endif