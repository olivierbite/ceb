<table class="pure-table pure-table-bordered">
<caption> {{ trans('reports.bilan') }} </caption>
	<thead>
		<tr>
			<th>{{ trans('account.account_number') }}</th>
			<th>{{ trans('account.titled') }}</th>
			<th>{{ trans('account.debit') }}</th>
			<th>{{ trans('account.credit') }}</th>
			<th>{{ trans('account.balance') }}</th>
		</tr>
	</thead>
	<tbody>
	<?php $debits = 0; $credits = 0; ?>
	@forelse ($accounts as $account)
	<?php try { ?>
	<tr>
		<td>{!! $account->account_number !!}</td>
		<td>{!! $account->entitled !!}</td>
		<td>{!! $debit =  $account->debits()->betweenDates(Request::segment(4),Request::segment(5))->sum('amount') !!}</td>
		<td>{!! $credit = $account->credits()->betweenDates(Request::segment(4),Request::segment(5))->sum('amount') !!}</td>
		<?php $balance = $credit - $debit ?>
		<td>{!! ($balance < 0 ) ? -1*$balance : $balance  !!}</td>

		<?php $debits+=$debit; $credits+=$credit; ?>
	</tr>
	<?php 
	} catch (Exception $e) {
		dd($account->postings()->debits()->betweenDates(Request::segment(4),Request::segment(5)));		
	} ?>
	@empty
		{{-- empty expr --}}
	@endforelse
	<tr>

			<th colspan="2"></th>
			<th>{!! $debits !!}</th>
			<th>{!! $credits !!}</th>
			<?php $balance = $credits - $debits; ?>

			<th>{!! $balance < 0 ? -1*$balance: $balance !!}</th>
		</tr>
	</tbody>
</table>