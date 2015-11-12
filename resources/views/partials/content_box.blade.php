<div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">@yield('content_title')</h3>
              <div class="box-tools">
              {{-- Request::is('regularisation/types') --}}
              @if ((Request::is('members*') || Request::is('loans*') || Request::is('regularisation*')) && !Request::is('loans/pending*'))
              
              @if(!Request::is('regularisation/types') && !Request::is('regularisation/regulate') && !Request::isMethod('post'))
                 @include('members.search')
              @endif

             @endif
            </div>
            <div class="box-body">
              @yield('content')
            </div><!-- /.box-body -->
            <div class="box-footer">
              @yield('content_footer')
          </div><!-- /.box-footer-->
</div>