<div style="border: 1px solid #323232;padding: 2px;">

        @if ($contributionHasDifference !== true)
        {!! Form::open(array('route'=>$route,'method'=>'POST', 'files'=>true)) !!}
        <label style="float:left;text-decoration: underline;">Batch upload </label>
        {!! Form::file('file',['style'=>'float:left;margin-left:10px;width:180px;']) !!} 
        {!! Form::submit('upload', array('class'=>'btn btn-success','style'=>'padding-left:10px;')) !!}

        <a href="{{ route('contributions.sample.csv') }}" class="btn btn-info">
            <i class="fa fa-file-excel-o"></i> {{ trans('general.download_sample') }}
        </a>
        @endif
        @if ($contributionHasDifference == true)
			<a href="{{ route('contributions.index') }}?remove-member-with-differences=yes" class="btn btn-warning">
            {{ trans('contribution.remove_with_difference') }}         
            </a>
            <a href="{{ route('contributions.export') }}?export-member-with-differences=yes" class="btn btn-primary" target="_blank">
            <i class="fa fa-file-excel-o"></i>
            {{ trans('contribution.export_differences') }}         
            </a>
        @endif

       @if ($uploadsWithErrors == true)
            <a href="{{ route('contributions.export') }}?export-member-with-errors=yes" class="btn btn-inverse" target="_blank">
            <i class="fa fa-file-excel-o"></i>
            {{ trans('contribution.export_uploaded_with_errors') }}         
            </a>
        @endif
    {!! Form::close() !!}
    
</div>