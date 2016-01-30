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
        	<a href="{{ route('contributions.index') }}?show-member-with-difference=yes" class="btn btn-danger">
            {{ trans('contribution.with_difference') }}</a>
			<a href="{{ route('contributions.index') }}?remove-member-with-differences=yes" class="btn btn-warning">
            {{ trans('contribution.remove_with_difference') }}         
            </a>
            <a href="{{ route('contributions.index') }}?export-member-with-differences=yes" class="btn btn-primary">
            <i class="fa fa-file-excel-o"></i>
            {{ trans('contribution.export_differences') }}         
            </a>
        @endif
    {!! Form::close() !!}
</div>