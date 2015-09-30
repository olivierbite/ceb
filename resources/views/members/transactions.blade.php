

<link href="{{Url()}}/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="{{Url()}}/assets/dist/css/modalPopup.css" rel="stylesheet" type="text/css" />

<div class="container">
    <div class="row">
        <!-- You can make it whatever width you want. I'm making it full width
             on <= small devices and 4/12 page width on >= medium devices -->
        <div class="col-xs-8 col-md-8 ModalPopup">
        
        
            <!-- CREDIT CARD FORM STARTS HERE -->
            <div class="panel panel-default credit-card-box">
            <a href="#" class="close-popdown">close</a>
                <div class="panel-heading display-table" >
                    <div class="row display-tr" style="text-align: center;font-weight: 700;" >
                        <h3 class="panel-title display-td" >{{ trans('member.transactions_and_other_withdrawals_on_savings') }}</h3>
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
                            <div class="col-xs-4 col-md-4">
                                <div class="form-group">
                                    <label for="movement_type">
	                                	 {{ trans('member.movement_type') }}
                                     </label>
                                   	 {!! Form::select('movement_type', array_keys($memberTransactions), null, ['class'=>'form-control movement_type']) !!}
                                </div>
                            </div>
                           <div class="col-xs-4 col-md-4">
                                <div class="form-group">
                                    <label for="operation_type">
	                                	 {{ trans('member.operation_type') }}
                                     </label>
                                   	 {!! Form::select('operation_type', [trans('member.select_movement_type_first')], null, ['class'=>'form-control operation_type']) !!}
                                </div>
                            </div>
                           <div class="col-xs-4 col-md-4">
                                <div class="form-group">
                                    <label for="amount">
	                                	 {{ trans('member.amount') }}
                                     </label>
                                   	 {!! Form::input('tel', 'amount', 0, ['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4 col-md-4">
                                <div class="form-group">
                                    <label for="wording">
	                                	 {{ trans('member.wording') }}
                                     </label>
                                   	 	 {!! Form::input('text', 'wording', null, ['class'=>'form-control','placeholder'=>trans('general.write_your_wording')]) !!}
                                </div>
                            </div>
                           <div class="col-xs-4 col-md-4">
                                <div class="form-group">
                                    <label for="cheque_number">
	                                	 {{ trans('member.cheque_number') }}
                                     </label>
                                   	 {!! Form::input('text', 'cheque_number', null, ['class'=>'form-control','placeholder'=>trans('general.cheque_number')]) !!}
                                </div>
                            </div>
                           <div class="col-xs-4 col-md-4">
                                <div class="form-group">
                                    <label for="bank">
	                                	 {{ trans('member.bank') }}
                                     </label>
                                   	 {!! Form::select('bank', [], null, ['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <button class="btn btn-success btn-lg btn-block" type="submit">{{ trans('general.save') }}</button>
                            </div>
                        </div>
                        <div class="row" style="display:none;">
                            <div class="col-xs-12">
                                <p class="payment-errors"></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>            
            <!-- CREDIT CARD FORM ENDS HERE -->
        </div>                    
    </div>
</div>
<script type="text/javascript">
  var savingsType = {!! json_encode($memberTransactions['saving']) !!} ;
  var withdrawalType = {!! json_encode($memberTransactions['withdrawal']) !!} ;

    $(document).ready(function(){
    $('.movement_type').on('change',function(event) {
      /* Act on the event */
      if($(this).val() == 1)
      {
        var options = '';
        $.each(savingsType, function(index, val) {
           options += '<option value="' +  val + '">' + val + '</option>';
        });
        $(".operation_type").html(options);
        return ;
      }

      if($(this).val() == 2)
      {
         var options = '';
        $.each(withdrawalType, function(index, val) {
           options += '<option value="' +  val + '">' + val + '</option>';
        });
        $(".operation_type").html(options);
        return;
      }

      $(".operation_type").html('<option value="0">Select movement type first</option>');
    });
  });
</script>