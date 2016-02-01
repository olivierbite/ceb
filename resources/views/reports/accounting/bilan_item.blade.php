<table class="pure-table pure-table-bordered">
<caption>{!! $accounts->first()->account_nature !!}</caption>
	<thead>
		<tr>
			<th>{{ trans('account.account_number') }}</th>
			<th>{{ trans('account.entitled') }}</th>
			{{-- <th>{{ trans('account.debit') }}</th> --}}
			{{-- <th>{{ trans('account.credit') }}</th> --}}
			<th>{{ trans('account.balance') }}</th>
		</tr>
	</thead>
	<tbody>
	<?php $debits = 0; $credits = 0;?>
	<?php $accountNature = null; ?>
	@forelse ($accounts as $account)
	<?php try { ?>
	<tr>
		<td>{!! $account->account_number !!}</td>
		<td>{!! $account->entitled !!}</td>
		<?php $debit =  $account->debits()->betweenDates(Request::segment(4),Request::segment(5))->sum('amount') ?>
		{{-- <td style="text-align: center">{!! number_format(abs($debit)) !!}</td> --}}
		<?php  $credit = $account->credits()->betweenDates(Request::segment(4),Request::segment(5))->sum('amount') ?>
		{{-- <td style="text-align: center">{!! number_format(abs($credit))  !!}</td> --}}
		<td style="text-align: center">
			{!! number_format( abs(abs($debit) - abs($credit)))  !!}
		</td>

		<?php $debits+=$debit; $credits+=$credit; ?>
	</tr>
	<?php 
	} catch (Exception $e) {
			
	} ?>
	@empty
		{{-- empty expr --}}
	@endforelse
	   <tr>
	 		<th colspan="2">{{ trans('general.summary') }}</th>
			<th>{!! number_format(abs($debits)) !!}</th>
			<th>{!! number_format(abs($credits)) !!}</th>
			<th>{!! number_format(abs(abs($debits) - abs($credits))) !!}</th>
		</tr>
	</tbody>
</table>