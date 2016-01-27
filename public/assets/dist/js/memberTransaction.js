jQuery(document).ready(function($) {
    /** SET Operation type if it is changed */
    $(".movement_type").change(function(event) {
      var loanType = $(this);
  
      window.location.href = window.location.protocol+'//'+window.location.host+window.location.pathname+'?movement_type='+loanType.val();
    });
    
    /** UPDATE ACCOUNTS AMOUNT */
    /** @todo map the right amount to the right account */
    if ($('#operation_type').val()=='saving') {
      $('#debit_amount_0').val($('#additional_amount').val());
      $('#debit_amount_2').val($('#additional_amount').val());

      $('#credit_amounts_0').val($('#netToReceive').val());
      $('#credit_amounts_2').val($('#interests_to_pay').val());
      $('#credit_amounts_4').val($('#additinal_charges').val());
    };

    if ($('#operation_type').val()=='withdrawal') {
      $('#debit_amount_0').val($('#additional_amount').val());
      $('#debit_amount_2').val($('#additional_amount').val());

      $('#credit_amounts_0').val($('#netToReceive').val());
      $('#credit_amounts_2').val($('#interests_to_pay').val());
      $('#credit_amounts_4').val($('#additinal_charges').val());
    };
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
                    $('.submit-member-transaction-button').attr('disabled', true);
                    $('.submit-member-transaction-button').html('<img src="/assets/dist/img/loading.gif" />');

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

                      $('.submit-member-transaction-button').html("{{ trans('general.save') }}");
                      $('.submit-member-transaction-button').removeAttr('disabled');
                      $('#member-transaction-form :input').removeAttr('disabled');
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

                      $('.submit-member-transaction-button').html("{{ trans('general.save') }}");
                      $('.submit-member-transaction-button').removeAttr('disabled');
                      $('#member-transaction-form :input').removeAttr('disabled');
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