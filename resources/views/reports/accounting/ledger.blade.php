@if (!$postings->isEmpty())
<?php $account = $postings->first()->account; ?>
<center><b><caption> {{ ucfirst(trans('reports.grand_livre') )}} </caption></b></center><br></br>
<strong>{{ trans('account.account_number') }} : </strong>{!! $account->account_number !!}, 
<strong>{{ trans('account.entitled') }} :</strong> {!! $account->entitled !!}, 
<strong>{{ trans('accounting_nature.account_nature') }} :</strong> {!! $account->account_nature !!}, 
<strong>{{ trans('general.between') }} :</strong> {!! request()->segment(4) !!} {{ trans('general.and') }} {!! request()->segment(5) !!}
<hr/>
<table class="pure-table pure-table-bordered">
<caption> {{ trans('report.ledger') }} </caption>
	<thead>
		<tr>
			<th>{{ trans('account.date') }}</th>
			<th>{{ trans('posting.transactionid') }}</th>
			<th>{{ trans('account.wording') }}</th>
			<th>{{ trans('account.debit') }}</th>
			<th>{{ trans('account.credit') }}</th>
			<th>{{ trans('account.balance') }}</th>
		</tr>
	</thead>
	<tbody>
	<?php $totalDebit = 0; ?>
	<?php $totalCrebit= 0; ?>
	<?php $balance = 0; ?>
	@forelse ($postings as $posting)
	<tr>
		<td>{!! $posting->created_at->format('Y-m-d') !!}</td>
		<td>{!! $posting->transactionid !!}</td>
		<td>{!! $posting->wording !!}</td>
		<?php $totalDebit += abs($posting->debit_amount); ?>
		<?php $balance  += abs($posting->debit_amount);?>

		<?php $totalCrebit+= abs($posting->credit_amount); ?>
		<?php $balance  -= abs($posting->credit_amount);?>

		<td>{!! number_format(abs($posting->debit_amount)) !!}</td>
		<td>{!! number_format(abs($posting->credit_amount)) !!}</td>
		<td>{!! number_format(abs($balance)) !!}</td>
	</tr>
	@empty
		{{-- empty expr --}}
	@endforelse
	<tr>
			<th colspan="3"><b>{{ trans('posting.movement_total') }}:</b></th>
			<th>{!! number_format($totalDebit) !!}</th>
			<th>{!! number_format($totalCrebit) !!}</th>
			<th>{!! number_format(abs($balance)) !!}</th>
		</tr>
	</tbody>
</table>
@endif