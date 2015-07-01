<header class="main-header">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>C</b>EB</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>CEB</b>MS</span>
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
              <!-- Messages: style can be found in dropdown.less-->

              <!-- Notifications: style can be found in dropdown.less -->

              <!-- Tasks: style can be found in dropdown.less -->

              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="/assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                  <span class="hidden-xs">{{ Session::get('email') }}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="/assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
                    <p>
                      Kamaro Lambert - Web Developer
                      <small>Member since Nov. 2012</small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">{{ trans('member.contribution') }}</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">{{ trans('member.files') }}</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">{{ trans('member.Epargne') }}</a>
                    </div>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">{{ trans('member.profile') }}</a>
                    </div>
                    <div class="pull-right">
                      <a href="#" class="btn btn-default btn-flat">{{ trans('member.logout') }}</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
            </ul>
          </div>
        </nav>
      </header>