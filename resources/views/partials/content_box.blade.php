<div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">@yield('content_title')</h3>
              <div class="box-tools">
              @if ((Request::is('members*') || Request::is('loans*') || Request::is('regularisation*')) && !Request::is('loans/pending*'))
               @include('members.search')
             @endif
            </div>
            <div class="box-body">
              @yield('content')
            </div><!-- /.box-body -->
            <div class="box-footer">
              @yield('content_footer')
          </div><!-- /.box-footer-->
</div>