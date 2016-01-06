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
			<th>{{ trans('posting.transactionid') }}</th>
			<th>{{ trans('account.wording') }}</th>
			<th>{{ trans('account.debit') }}</th>
			<th>{{ trans('account.credit') }}</th>
		</tr>
	</thead>
	<tbody>
	<?php $totalDebit = 0; ?>
	<?php $totalCrebit= 0; ?>
	@forelse ($postings as $posting)
	<tr>
		<td>{!! $posting->created_at->format('Y-m-d') !!}</td>
		<td>{!! $posting->transactionid !!}</td>
		<td>{!! $posting->wording !!}</td>
		<?php $totalDebit += abs($posting->debit_amount); ?>
		<?php $totalCrebit+= abs($posting->credit_amount); ?>
		<td>{!! number_format(abs($posting->debit_amount)) !!}</td>
		<td>{!! number_format(abs($posting->credit_amount)) !!}</td>
	</tr>
	@empty
		{{-- empty expr --}}
	@endforelse
	<tr>
			<th colspan="2"><b>{{ trans('posting.movement_total') }}:</b></th>
			<th>{!! number_format($totalDebit) !!}</th>
			<th>{!! number_format($totalCrebit) !!}</th>
		</tr>
	</tbody>
</table>
@endif