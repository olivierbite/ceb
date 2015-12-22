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
<table class="pure-table pure-table-bordered">
<caption> {{ trans('reports.journal') }} </caption>
	<thead>
		<tr>
			<th>{{ trans('posting.transactionid') }}</th>
			<th>{{ trans('posting.date') }}</th>
			<th>{{ trans('posting.wording') }}</th>
			<th>{{ trans('posting.account_number') }}</th>		
			<th>{{ trans('posting.debit') }}</th>
			<th>{{ trans('posting.credit') }}</th>
		</tr>
	</thead>
	<tbody>
	<?php $transactionid = null; ?>
	<?php $date = null; ?>
	<?php $rowspan = 0; ?>
	@forelse ($postings as $posting)

		@if ($date != $posting->created_at->format('Y-m-d'))
		<?php $date = $posting->created_at->format('Y-m-d'); ?>
		<tr>
			<td class="account-details" colspan="6" style="font-weight: bold">{!! $date !!}</td>
		</tr>
		@endif

		<tr>
			{{-- control the display of the transactions --}}
			@if ($transactionid != $posting->transactionid)
				<?php $transactionid = $posting->transactionid ?> 
				{{-- detrmine how many rows do we have to span as per affected account for this transaction --}}
				<?php $rowspan = $postings->where('transactionid',$transactionid)->count(); ?>

				<td rowspan="{!! $rowspan !!}">
				    {!! $posting->transactionid !!}
				 </td>
				<td rowspan="{!! $rowspan !!}">
				    {!! $posting->created_at->format('Y-m-d') !!}
				</td>
				<td rowspan="{!! $rowspan !!}">{!! $posting->wording !!}</td>
			@endif
				<td class="account-details">{!! $posting->account->account_number !!}</td>
				<td class="account-details">{!! number_format($posting->debit_amount) !!}</td>
				<td class="account-details">{!! number_format($posting->credit_amount) !!}</td>
			</tr>

	@empty
		{{-- empty expr --}}
	@endforelse
	</tbody>
</table>