<!-- jQuery 2.1.4 -->
    <script src="{{Url()}}/assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="{{ Url()}}/assets/dist/js/config.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{Url()}}/assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="{{Url()}}/assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="{{Url()}}/assets/dist/js/jquery.numeric.js"></script>
    <!-- FastClick -->
    <script src='/assets/plugins/fastclick/fastclick.min.js'></script>

    <!-- libraries -->
    <script src="{{Url()}}/assets/dist/js/select2.full.js" type="text/javascript"></script>
    <script src="{{Url()}}/assets/dist/js/handlebars.js" type="text/javascript"></script>
    <script src="{{Url()}}/assets/dist/js/typeahead.js" type="text/javascript"></script>
    
    <script src="{{Url()}}/assets/dist/js/jquery.validate.min.js" type="text/javascript"></script>
    
     <!-- CEB App -->
    <script src="{{Url()}}/assets/dist/js/app.js" type="text/javascript"></script>

    @yield('scripts')


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
<div class="block title">
@if (strpos($title , '.') === false)
    {!! trans('report.'.$title)  !!}
@else 
    <?php $title = explode('.',$title); ?>
    <?php unset($title[0]) ?>
    {!!  trans('report.'. implode('_', $title)) !!}
@endif
    
</div>
   <div href="#" class="close-popdown block">
    <i class="fa fa-times"></i>
    </div>
</div>
<p>
	@yield('content')
</p> 
</div>