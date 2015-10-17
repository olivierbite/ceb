@extends('partials.scripts')

@section('scripts')

<style type="text/css">
.wrap {
    background: #fff;
    margin: 20px auto;
    display: block;
    width: 100%;
    height: auto;
    padding:20px;
    border-radius: 2px 2px 2px 2px; 
    -webkit-box-shadow: 0 1px 4px 
    rgba(0, 0, 0, 0.3), 0 0 40px 
    rgba(0, 0, 0, 0.1) inset;
    -moz-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
    box-shadow: 0 1px 4px 
    rgba(0, 0, 0, 0.3), 0 0 40px 
    rgba(0, 0, 0, 0.1) inset;
}
.title{
	font-size: 16px;
	font-weight: 500;
}

.header{
	width: 100%;
}
.block{
	display: inline-block;
	width: auto;
	zoom:1;
}
.close-popdown{
	margin-right: 0px;
	float: right;
}
</style>
<div class="wrap ">
<div class="header">
<input type="hidden" class="report-name" value="{!! $reportUrl !!}">
<div class="block title">{!! $title !!}</div>
   <div href="#" class="close-popdown block">
    <i class="fa fa-times"></i>
    </div>
</div>
<p>
	@yield('content')
</p> 
</div>

@stop