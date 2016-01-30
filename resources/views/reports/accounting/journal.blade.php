<style type="text/css">
	.account-details{
		border:none !important;
		text-align:center !important;
		border-left:1px solid !important;
		border-bottom:  1px !important;
		border-bottom-style:dashed !important;
	}
	.posting-details{
		border:none !important;
		border-bottom: 1px solid green !important;
		font-weight: bold !important;
	}
</style>
<table class="pure-table pure-table-bordered" style="border: 1px solid #000">
<caption> {{ ucfirst(trans('reports.reports_journal') )}} {{ Request::segment(4).' Et '.Request::segment(5) }}</caption>
	<thead>
		<tr>
			<th>{{ trans('posting.transactionid') }}</th>
			<th>{{ trans('posting.date') }}</th>
			<th>{{ trans('posting.wording') }}</th>
			<th>{{ trans('posting.account_number') }}</th>		
			<th>{{ trans('posting.debit') }}</th>
			<th>{{ trans('posting.credit') }}</th>
			<th>{{ trans('posting.balance') }}</th>
		</tr>
	</thead>
	<tbody>
	<?php $transactionid = null; ?>
	<?php $date = null; ?>
 	<?php $balance = 0; ?>
	<?php $rowspan = 0; ?>
	<?php $latestRow = false ; ?>
	@forelse ($postings as $posting)
		
		{{-- Debit and credit to get balance --}}
		<?php $balance += $posting->credit_amount; ?>
		<?php $balance -= $posting->debit_amount; ?>

		@if ($date != $posting->created_at->format('Y-m-d'))
		<?php $date = $posting->created_at->format('Y-m-d'); ?>
		<tr style="border-bottom: 1px solid #000">
			<td class="account-details" colspan="6" style="font-weight: bold">{!! $date !!}</td>
		</tr>
			<?php $latestRow = true; ?>
		@endif

		<tr style="{!! ($date != $posting->created_at->format('Y-m-d')) ? 'border-bottom: 1px solid #000':'' !!}">
			{{-- control the display of the transactions --}}
			@if ($transactionid != $posting->transactionid)
				<?php $transactionid = $posting->transactionid ?> 
				{{-- detrmine how many rows do we have to span as per affected account for this transaction --}}
				<?php $rowspan = $postings->where('transactionid',$transactionid)->count(); ?>
	
				<?php $latestRow = false; ?>
				<td rowspan="{!! $rowspan !!} " style="border-bottom: 1px solid #000">
				    {!! $posting->transactionid !!}
				 </td>
				<td rowspan="{!! $rowspan !!}" style="border-bottom: 1px solid #000">
				    {!! $posting->created_at->format('Y-m-d') !!}
				</td>
				<td rowspan="{!! $rowspan !!}" style="border-bottom: 1px solid #000">{!! $posting->wording !!}</td>
					@else

			<?php $latestRow = true; ?>
			@endif
				<td align="left" style="{!! ($latestRow || $rowspan == 1)?'border-bottom: 1px solid #000':'' !!};text-align: left">{!! $posting->account->account_number  !!} - {!! $posting->account->entitled  !!} </td>
				<td style="{!! ($latestRow || $rowspan == 1)?'border-bottom: 1px solid #000':'' !!};text-align: center">{!! number_format($posting->debit_amount) !!}</td>
				<td style="{!! ($latestRow || $rowspan == 1)?'border-bottom: 1px solid #000':'' !!};text-align: center">{!! number_format($posting->credit_amount) !!}</td>
				<td style="{!! ($latestRow || $rowspan == 1)?'border-bottom: 1px solid #000':'' !!};text-align: center">{!! number_format(abs($balance)) !!}</td>
			</tr>

	@empty
		{{-- empty expr --}}
	@endforelse
	</tbody>
</table>