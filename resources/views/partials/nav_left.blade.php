<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{route('files.get', Sentry::getUser()->photo)}}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p>{{ Session::get('email') }}</p>

              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">{{ trans('navigations.main_navigation') }}</li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i>
                <span>{{ trans('navigations.dashboard') }}</span>
              </a>
            </li>
            <li class="{{ (Request::is('members*') ? 'active' : '') }} treeview">
              <a href="{{ route('members.index') }}">
                <i class="fa fa-users"></i>
                <span>{{ trans('navigations.members') }}<span>
                <span class="label label-primary pull-right">4</span>
              </a>
            </li>
            <li>
              <a href="{{ route('contributions.index') }}">
                <i class="fa fa-th"></i> <span>{{ trans('navigations.contributions_and_savings') }}</span>
              </a>
            </li>
            <li class="treeview">
              <a href="{{ route('loans.index') }}">
                <i class="fa fa-pie-chart"></i>
                <span>{{ trans('navigations.loans_and_repayments') }}</span>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-money"></i>
                <span>{{ trans('navigations.accounting') }}</span>
                </a>

            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-table"></i> <span>{{ trans('navigations.reports') }}</span>

              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> {{ trans('navigations.report_contrats') }}</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> {{ trans('navigations.report_files') }}</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-gears"></i>
                 <span>{{ trans('navigations.settings') }}</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> {{ trans('navigations.institutions') }}</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> {{ trans('navigations.accounting_plan') }}</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> {{ trans('navigations.closing_exercise') }}</a></li>
              </ul>
            </li>
            <li class="header"> </li>
            <li><a href="/assets/documentation/index.html"><i class="fa fa-book"></i>
            <span>{{ trans('navigations.help') }}</span></a>
            </li>
            <li class="header"> </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>