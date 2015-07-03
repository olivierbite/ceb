@if(isset($filename) && !empty($filename))

                    <img src="{{route('files.get', $filename)}}" alt="ALT NAME" class="img-responsive" />
@else 
	<i class="fa fa-picture-o" style="font-size:140px;"></i>
@endif