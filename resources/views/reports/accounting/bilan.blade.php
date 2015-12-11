<table class="pure-table pure-table-bordered">
<caption> {{ trans('reports.bilan') }} {{ Request::segment(4).'  '.Request::segment(5) }} </caption>
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
	<?php $accountNature = null; ?>
	@forelse ($accounts as $account)
	<?php try { ?>
	@if ($accountNature != $account->account_nature)
	 @if ($debits!=0 || $credits!=0)
	 	<tr>
	 		<th colspan="2">{{ trans('general.summary') }}</th>
	 		<th>{!! number_format(abs($debits)) !!}</th>
			<th>{!! number_format(abs($credits)) !!}</th>
			<th>{!! number_format(abs($debits - $debits))  !!}</th>
	 	</tr>
	 @endif
	  <tr>
			<th colspan="5">{{ $accountNature = $account->account_nature }}</th>
		</tr>
	@endif
	<tr>
		<td>{!! $account->account_number !!}</td>
		<td>{!! $account->entitled !!}</td>
		<?php $debit =  $account->debits()->betweenDates(Request::segment(4),Request::segment(5))->sum('amount') ?>
		<td>{!! abs($debit) !!}</td>
		<?php  $credit = $account->credits()->betweenDates(Request::segment(4),Request::segment(5))->sum('amount') ?>
		<td>{!! abs($credit)  !!}</td>
		<td>{!! abs($credit - $debit)  !!}</td>

		<?php $debits+=$debit; $credits+=$credit; ?>
	</tr>
	<?php 
	} catch (Exception $e) {
			
	} ?>
	@empty
		{{-- empty expr --}}
	@endforelse
	<tr>
			<th colspan="2"></th>
			<th>{!! abs($debits) !!}</th>
			<th>{!! abs($credits) !!}</th>
			<th>{!! abs($debits - $debits) !!}</th>
		</tr>
	</tbody>
</table>