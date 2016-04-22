<div style="border: 1px solid #323232;padding: 2px;">
    
    @if ($refundHasDifference == false)
        {!! Form::open(array('route'=>'refunds.batch','method'=>'POST', 'files'=>true)) !!}
        <label style="float:left;text-decoration: underline;">Batch upload </label>
        {!! Form::file('file',['style'=>'float:left;margin-left:10px;width:180px;']) !!} 
        {!! Form::submit('upload', array('class'=>'btn btn-success','style'=>'padding-left:10px;')) !!}

        <a href="{{ route('contributions.sample.csv') }}" class="btn btn-info">
            <i class="fa fa-file-excel-o"></i> {{ trans('general.download_sample') }}
        </a>
    @endif
        @if ($refundHasDifference == true)
			<a href="{{ route('refunds.index') }}?remove-member-with-differences=yes" class="btn btn-warning">
            {{ trans('refunds.remove_with_difference') }}         
            </a>
            <a href="{{ route('refunds.export') }}?export-member-with-differences=yes" class="btn btn-primary" target="_blank">
            <i class="fa fa-file-excel-o"></i>
            {{ trans('refunds.export_differences') }}         
            </a>
        @endif

       @if ($uploadHasErrors == true)
            <a href="{{ route('refunds.export') }}?export-member-with-errors=yes" class="btn btn-inverse" target="_blank">
            <i class="fa fa-file-excel-o"></i>
            {{ trans('refunds.export_uploaded_with_errors') }}         
            </a>
        @endif
    {!! Form::close() !!}
    
</div>