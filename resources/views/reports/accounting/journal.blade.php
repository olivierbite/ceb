<style type="text/css">
	.account-details{
		border:none;
		text-align:center;
		border-left:1px solid;
		border-bottom:  1px;
		border-bottom-style:dashed;
	}
	.posting-details{
		border:none;
		border-bottom: 1px solid green;
		font-weight: bold;
	}
</style>
<table border="1">
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
			<td colspan="6">{!! $date !!}</td>
		</tr>
		@endif

		<tr>
			{{-- control the display of the transactions --}}
			@if ($transactionid != $posting->transactionid)
				<?php $transactionid = $posting->transactionid ?> 
				{{-- detrmine how many rows do we have to span as per affected account for this transaction --}}
				<?php $rowspan = $postings->where('transactionid',$transactionid)->count(); ?>

				<td class="posting-details" rowspan="{!! $rowspan !!}">
				    {!! $posting->transactionid !!}
				 </td>
				<td class="posting-details" rowspan="{!! $rowspan !!}">
				    {!! $posting->created_at->format('Y-m-d') !!}
				</td>
				<td class="posting-details" rowspan="{!! $rowspan !!}">{!! $posting->wording !!}</td>
			@endif
				<td class="account-details">{!! $posting->account->account_number !!}</td>
				<td class="account-details">{!! $posting->debit_amount !!}</td>
				<td class="account-details">{!! $posting->credit_amount !!}</td>
			</tr>

	@empty
		{{-- empty expr --}}
	@endforelse
	</tbody>
</table>