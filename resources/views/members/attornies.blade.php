<link href="{{Url()}}/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="{{Url()}}/assets/dist/css/modalPopup.css" rel="stylesheet" type="text/css" />

<div class="container">
    <div class="row">
        <!-- You can make it whatever width you want. I'm making it full width
             on <= small devices and 4/12 page width on >= medium devices -->
        <div class="col-xs-8 col-md-8 ModalPopup"> 
            <!-- CREDIT CARD FORM STARTS HERE -->
            <div class="panel panel-default credit-card-box">
                <div class="panel-heading display-table" >
                    <div class="row display-tr" style="text-align: center;font-weight: 700;" >
                        <h3 class="panel-title display-td" >{{ trans('member.member_attornies_list') }}</h3>
                                <div class="col-md-1">
                                  <div style="width:70px;border:2px solid rgba(0,0,0,0.8);">
                                    @include('files.show',['filename'=>$member->photo])
                                  </div>
                                </div>
                                  <div class="col-md-3">
                                      <div class="form-group">
                                       <label>{{ trans('member.adhersion_number') }}</label>
                                       <br/>
                                        {!! $member->adhersion_id !!}
                                      </div>
                                  </div>
                                    <div class="col-md-3">
                                      <div class="form-group">
                                       <label>{{ trans('member.names') }}</label>
                                       <br/>
                                        {!! $member->first_name.' '.$member->last_name !!}
                                      </div>
                                  </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                   <label>{{ trans('member.institution') }}</label>
                                   <br/>
                                    {!! isset($member->institution()->name) ? $member->institution()->name : null !!}
                                  </div>
                                  </div>
                            </div>
                        </div>        
                </div>
                <div class="panel-body">
                    <form role="form" id="payment-form">

                        <div class="row">
                           @each ('attornies.item', $member->attornies, 'attorney', 'members.no-items')

                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                               <a href="#" class="close-popdown btn btn-success btn-lg btn-block" >
                                {{ trans('general.close') }}
                                </a>
                            </div>
                        </div>
                </div>
            </div>            
            <!-- CREDIT CARD FORM ENDS HERE -->
            
            
        </div>            
        
        
    </div>
</div>

