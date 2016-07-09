<header class="main-header">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><img src="{{Url('assets/dist/img/logo.jpg')}}" style="width:40px;height:40px;"></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><img src="{{Url('assets/dist/img/logo.jpg')}}" style="width:40px;height:40px;"><b>KSSF</b>MS</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
            @if (\Sentry::check())
              @if (\Sentry::getUser()->hasAccess('utility.can.do.database.backup'))
                <li>
                <a href="{{ route('utility.backup') }}" class="label label-warning" style="font-size: 14px;">
                  <i class="fa fa-floppy-o"></i> {{ trans('general.make_database_backup') }}
                </a>
                </li>
              @endif                
            @endif
              <!-- USER NOTIFICATIO -->
              @include('partials.user-notification')
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <div class="user-image">
                      @include('files.show',['filename'=>\Sentry::getUser()->photo])
                    </div> 
                  <span class="hidden-xs">{{ \Sentry::getUser()->username }}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    @include('files.show',['filename'=>\Sentry::getUser()->photo])
                    <p>
                     {!! \Sentry::getUser()->first_name .' '.\Sentry::getUser()->last_name !!}
                      <small>Member since {!! \Sentry::getUser()->created_at->format('M. Y') !!}</small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                    <a href="{{ route('sentinel.profile.show') }}" class="btn btn-default btn-flat">{{ trans('member.profile') }}</a>
                    </div>
                    <div class="pull-right">
                      <a href="{{ route('sentinel.logout') }}" class="btn btn-default btn-flat">{{ trans('member.logout') }}</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
            </ul>
          </div>
        </nav>
      </header>