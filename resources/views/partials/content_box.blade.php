<div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">@yield('content_title')</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              @yield('content')
            </div><!-- /.box-body -->
            <div class="box-footer">
              @yield('content_footer')
          </div><!-- /.box-footer-->
</div>