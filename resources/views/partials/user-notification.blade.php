<?php $user = $CebUser->find(\Sentry::getUser()->id) ?>
<li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">{!! $user->countNotificationsNotRead(); !!}</span>
            </a>
            <ul class="dropdown-menu notifications">
              <li class="header">{{ trans('general.your') }} {!! $user->countNotificationsNotRead(); !!} {{ trans('general.notifications') }} </li>
              <li>
                <!-- inner menu: contains the actual data -->
                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;"><ul class="menu" style="overflow: hidden; width: 100%; height: 200px;">
                @foreach ($user->getNotificationsNotRead($limit = 20, $paginate = null, $order = 'desc') as $notification)
                   <li>
                    <a href="{!! $notification->url !!}">
                      <i class="{!! trans($notification->body->name.'-icon') !!}"></i> {!! $notification->text !!}
                    </a>
                  </li>
                @endforeach
                </ul><div class="slimScrollBar" style="width: 3px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 195.122px; background: rgb(0, 0, 0);"></div><div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div></div>
              </li>
              <li class="footer"><a href="{!! route('notificatons') !!}">{{ trans('general.view_all') }}</a></li>
            </ul>
          </li>