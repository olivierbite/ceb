<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              @include('files.show',['filename'=>Sentry::getUser()->photo])
            </div>
            <div class="pull-left info">
              <p>{{ Session::get('email') }}</p>

              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">{{ trans('navigations.main_navigation') }}</li>
            <li class="{{ (Request::is('/') ? 'active' : '') }} treeview">
              <a href="{{ route('home') }}">
                <i class="fa fa-dashboard"></i>
                <span>{{ trans('navigations.dashboard') }}</span>
              </a>
            </li>
            <li class="{{ (Request::is('members*') ? 'active' : '') }} treeview">
              <a href="{{ route('members.index') }}">
                <i class="fa fa-users"></i>
                <span>{{ trans('navigations.members') }}<span>
                <span class="label label-primary pull-right">{!! $membersCount !!}</span>
              </a>
            </li>
            <li class="{{ (Request::is('contributions*') ? 'active' : '') }} ">
              <a href="{{ route('contributions.index') }}">
                <i class="fa fa-th"></i> <span>{{ trans('navigations.contributions_and_savings') }}</span>
              </a>
            </li>
            <li class="{{ (Request::is('loan*') ? 'active' : '') }} ">
              <a href="#">
                <i class="fa fa-money"></i>
                <span>{{ trans('navigations.loans') }}</span>
               <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu {{ (Request::is('loan*') ? 'class="active"' : '') }}">
                <li>
                  <a href="{{ route('loans.index') }}">
                  <i class="fa fa-money"></i>{{ trans('navigations.give_loan') }}
                  </a>
                </li>

                <li >
                  <a href="{{ route('loan.pending') }}">
                  <i class="fa fa-money"></i>{{ trans('navigations.pending_loans') }}
                  </a>
                </li>
              </ul>
            </li>
           <li class="{{ (Request::is('regularisation*') ? 'active' : '') }} ">
              <a href="{{ route('regularisation.index') }}">
                <i class="fa fa-level-up"></i>
                <span>{{ trans('navigations.regularisation') }}</span>
               <i class="fa fa-angle-left pull-right"></i>
              </a>
                @if (count($regularisations) > 0 )
                <ul class="treeview-menu {{ (Request::is('regularisation*') ? 'class="active"' : '') }}">
                @foreach ($regularisations as $key=>$value)
                  <li>
                    <a href="{{ route('regularisation.type.'.$key) }}">
                    <i class="fa fa-level-up"></i>{{ trans($value) }}
                    </a>
                  </li>
                @endforeach
                </ul>
                @endif
            </li>
            <li class="{{ (Request::is('refund*') ? 'active' : '') }} ">
              <a href="{{ route('refunds.index') }}">
                <i class="fa fa-undo"></i>
                <span>{{ trans('navigations.refund') }}</span>
              </a>
            </li>

            <li class="{{ (Request::is('accounting*') ? 'active' : '') }} ">
              <a href="{{ route('accounting.index') }}">
                <i class="fa fa-briefcase"></i>
                <span>{{ trans('navigations.accounting') }}</span>
                </a>

            </li>
            <li class="{{ (Request::is('leave*') ? 'active' : '') }} ">
              <a href="{!! route('leaves.index') !!}">
                <i class="fa fa-calendar"></i> <span>{{ trans('navigations.leaves') }}</span>
              </a>
            </li>
            <li class="{{ (Request::is('items*') ? 'active' : '') }} ">
              <a href="{!! route('items.index') !!}">
               <i class="fa fa-tasks"></i></i> <span>{{ trans('navigations.items') }}</span>
              </a>
            </li>
            <li class="{{ (Request::is('report*') ? 'active' : '') }} ">
              <a href="{!! route('reports.index') !!}">
                <i class="fa fa-bar-chart"></i> <span>{{ trans('navigations.reports') }}</span>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-gears"></i>
                 <span>{{ trans('navigations.settings') }}</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                @if (Sentry::check() && Sentry::getUser()->hasAccess('admin'))
                <li {{ (Request::is('users*') ? 'class="active"' : '') }}>
                <a href="{{ route('ceb.settings.users.index') }}">
                <i class="fa fa-user"></i>{{ trans('navigations.user') }}
                </a>
                </li>
                <li {{ (Request::is('groups*') ? 'class="active"' : '') }}>
                <a href="{{ action('\\Sentinel\Controllers\GroupController@index') }}">
                 <i class="fa fa-users"></i> {{ trans('navigations.groups') }}
                </a>
                </li>
              @endif
                <li>
                  <a href="{!! route('settings.institution.index') !!}">
                    <i class="fa fa-bank"></i> 
                      {{ trans('navigations.institutions') }}
                  </a>
                </li>
                <li>
                   <a href="{!! route('settings.accountingplan.index') !!}">
                     <i class="fa fa-book"></i> 
                       {{ trans('navigations.accounting_plan') }}
                   </a>
                </li>
                <li>
                  <a href="#">
                     <i class="fa fa-lock"></i> 
                      {{ trans('navigations.closing_exercise') }}
                  </a>
                </li>
              </ul>
            </li>
            <li class="header"> </li>
            <li><a href="#"><i class="fa fa-question-circle"></i>
            <span>{{ trans('navigations.help') }}</span></a>
            </li>
            <li class="header"> </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>