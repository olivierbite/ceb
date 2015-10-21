<div style="border: 1px solid #323232;padding: 2px;">
      {!! Form::open(array('route'=>$route,'method'=>'POST', 'files'=>true)) !!}
        <label style="float:left;text-decoration: underline;">Batch upload </label>
        {!! Form::file('file',['style'=>'float:left;margin-left:10px;']) !!} 
        {!! Form::submit('upload', array('class'=>'btn btn-success','style'=>'padding-left:10px;')) !!}
        @if ($contributionHasDifference == true)
        	<a href="{{ route('contributions.index') }}?withDifferences=yes" class="btn btn-danger"> View member with different contributions</a>
        @endif
    {!! Form::close() !!}
</div>