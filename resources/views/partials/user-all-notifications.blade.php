@extends('layouts.default')
@section('content')
<?php $cebUser = $CebUser->find(\Sentry::getUser()->id); ?>

<div class="col-md-12">
          <!-- DIRECT CHAT PRIMARY -->
          <div class="box box-primary direct-chat direct-chat-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{ trans('general.user-notifications') }}</h3>

              <div class="box-tools pull-right">
                <span data-toggle="tooltip" title="3 New Messages" class="badge bg-light-blue">{!! $cebUser->countNotificationsNotRead(); !!}</span>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              @foreach ($cebUser->getNotificationsNotRead($limit = 20, $paginate = null, $order = 'desc') as $notification)          
              <!-- Conversations are loaded here -->
              <div class="direct-chat-messages">
                <!-- Message. Default to the left -->
                <div class="direct-chat-msg">
                  <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-left">{!! $notification->from->first_name !!} {!! $notification->from->last_name !!}</span>
                    <span class="direct-chat-timestamp pull-right">{!! $notification->updated_at->format('d M Y H:i') !!}</span>
                  </div>
                   <img class="direct-chat-img" src="{{route('files.get', $notification->from->photo)}}" alt="{!! $notification->from->first_name !!}">

                  <!-- /.direct-chat-img -->
                  <a href="{!! $notification->url !!}" class="direct-chat-text">
                    {!! $notification->text !!}
                  </a>
                  <!-- /.direct-chat-text -->
                </div>
                <!-- /.direct-chat-msg -->
            <!-- /.box-footer-->
          </div>

            @endforeach
          <!--/.direct-chat -->
        </div>
      </div>
    </div>

  @stop