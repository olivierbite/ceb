
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
                    <div class="row display-tr" style="text-align: center;" >
                        <h3 style="font-weight: 400;text-decoration: underline;margin: 0px;margin-bottom: 5%;">{{ trans('member.transactions_and_other_withdrawals_on_savings') }}</h3>
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
                                  <div class="col-md-2">
                                    <a href="#" class="btn btn-danger close-popdown"><i class="fa fa-times"></i></a>
                                  </div>
                            </div>
                        </div>        
                </div>
                <div class="panel-body">
                   <div class="notifications"></div>
                   {!! Form::open(['url'=>  route('members.completetransaction',['memberId'=>$member->id]),'id'=>'member-transaction-form']) !!}
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
                           <div class="col-xs-2 col-md-2">
                                <div class="form-group">
                                    <label for="amount">
	                                	 {{ trans('member.amount') }}
                                     </label>
                                   	 {!! Form::input('tel', 'amount', 0, ['class'=>'form-control']) !!}
                                </div>
                            </div>
                              <div class="col-xs-1 col-md-1">
                                <div class="form-group">
                                <label></label>
                                   {!! Form::checkbox('charge', 20, false,['style'=>'    position: absolute;
                                                                  display: block;
                                                                  width: 30%;
                                                                  height: 30%;
                                                                  margin: 0px;
                                                                  padding: 0px;
                                                                  border: 0px;'])
                                    !!}
                                    
                                </div>
                                2 %
                             </div>
                               <div class="col-xs-1 col-md-1">
                               <label></label>
                                <div class="form-group" >
                                   {!! Form::checkbox('charge', 20, false,['style'=>'    position: absolute;
                                                                  display: block;
                                                                  width: 30%;
                                                                  height: 30%;
                                                                  margin: 0px;
                                                                  padding: 0px;
                                                                  border: 0px;'])
                                    !!}
                                    
                                </div>
                                10 %
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
                                   	 {!! Form::select('bank', [0], null, ['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                         @include('accounting.form')
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


  /**
   * Implement validation
   */
  (function($,W,D)
{
    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#member-transaction-form").validate({
                rules: {
                    movement_type: "required",
                    operation_type:  "required",
                wording: {
                        required: true,
                        minlength: 10
                    },
                cheque_number: {
                        required: true,
                        minlength: 5
                    },
                amount: {
                        required: true,
                        minlength: 4
                    }
                },
                messages: {
                    movement_type: "Please select movement type",
                    operation_type: "Please select operation type",
                    bank: {
                        required: "Please provide a bank",
                        minlength: "Your bank must be at least 2 characters long"
                    },
                    wording: "Please enter a valid wording",
                    cheque_number: "Please enter a valid cheque_number",
                    amount: "Please enter a valid amount"
                },
                submitHandler: function(form) {
                   //Submit form with Ajax
                    $.ajax({
                     type: "POST",
                     url:  $("#member-transaction-form").attr('action'),
                     data:  $("#member-transaction-form").serialize(), // serializes the form's elements.
                     success: function(data)
                     {
                      
                      $('.popdown').close_popdown();

                      swal.setDefaults({ confirmButtonColor: '#5bb75b' });
                      swal({
                        title:"Transaction went well.",
                        text : data.responseText,
                        type :"success",
                        html :true
                      });
                     },
                    error: function (error) {
                      var errorMessages = JSON.parse(error.responseText);
                      var errorNotifications = '';
                      $.each(errorMessages, function(index, val) {
                         /* build notification */
                         errorNotifications +='<p style="color:#fff;">'+val+'</p>';
                      });
                     errorNotifications = '<div data-alert class="alert alert-error radius">'+errorNotifications+'</div>';

                      swal.setDefaults({ confirmButtonColor: '#d9534f' });
                      swal({
                        title:"Validation error",
                        text : errorNotifications,
                        type :"error",
                        html :true
                      });
                    }
                   });
                }
            });
        }
    }

    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
        JQUERY4U.UTIL.setupFormValidation();
    });

})(jQuery, window, document);
</script>

<script type="text/javascript">

    (function($){
        $countForms = 1;
        var accounts = {!! json_encode($accounts) !!};

        $accountsOptions = '';
         $.each(accounts, function(index, val) {
           $accountsOptions += '<option value="' +  index + '">' + val + '</option>';
        });

        $.fn.addCreditForms = function(){
          var myform = "<div class='form-group account-row' >"+
                       "     <div class='col-xs-6'>"+
                       "      <select class='form-control account' name='credit_accounts["+$countForms+"]'>"+$accountsOptions+"</select></td>"+
                       "     </div>"+
                       "     <div class='col-xs-4'>"+
                       "        <input class='form-control accountAmount' name='credit_amounts["+$countForms+"]' type='numeric' value='0'>"+
                       "     </div>"+         
                       "     <div class='col-xs-2'>"+
                       "        <button class='btn btn-danger'><i class='fa fa-times'></i></button> " +
                       "     </div>"+ 
                       "</div>";

           myform = $("<div>"+myform+"</div>");
           $("button", $(myform)).click(function(){ $(this).parent().parent().remove(); });

           $(this).append(myform);
           $countForms++;
        };

         $.fn.addDebitForms = function(){
          var myform = "<div class='form-group account-row' >"+
                       "     <div class='col-xs-6'>"+
                       "      <select class='form-control account' name='debit_accounts["+$countForms+"]'>"+$accountsOptions+"</select></td>"+
                       "     </div>"+
                       "     <div class='col-xs-4'>"+
                       "        <input class='form-control accountAmount' name='debit_amounts["+$countForms+"]' type='numeric' value='0'>"+
                       "     </div>"+         
                       "     <div class='col-xs-2'>"+
                       "        <button class='btn btn-danger'><i class='fa fa-times'></i></button> " +
                       "     </div>"+ 
                       "</div>";

           myform = $("<div>"+myform+"</div>");
           $("button", $(myform)).click(function(){ $(this).parent().parent().remove(); });

           $(this).append(myform);
           $countForms++;
        };
    })(jQuery);   

     $(function(){

      $("#add-credit-account").bind("click", function(){
        $("#credit-accounts-container").addCreditForms();
      });

      $("#add-debit-account").bind("click", function(){
        $("#debit-accounts-container").addDebitForms();
      });

    });
</script>