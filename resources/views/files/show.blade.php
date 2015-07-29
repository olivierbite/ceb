@if(isset($filename) && !empty($filename))
<img src="{{route('files.get', $filename)}}" alt="ALT NAME" class="img-responsive" />
@else
<img src="{!! Url() !!}/assets/dist/img/no-image.png" alt="ALT NAME" class="img-responsive" />
@endif