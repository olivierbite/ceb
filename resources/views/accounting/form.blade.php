{{-- <div class="box-body">
<div class="box-header with-border">
  <h3 class="box-title">{{ trans('accounting.accounting') }}</h3>
 </div>
<div class="row">
    <div class="col-md-6">
    	@include('accounting.debit_form')
    </div>
    <div class="col-md-6">
    	@include('accounting.credit_form')
    </div>
</div>
</div> --}}
<div class="box-header with-border">
  <h3 class="box-title">{{ trans('accounting.accounting') }}</h3>
 </div>
<div class="row">
    <div class="col-md-6">
     @include('accounting.debit')
  </div>
    <!-- START OF CREDIT ACCOUNT -->
    <div class="col-md-6">
      @include('accounting.credit')
    </div>
     <!-- END OF CREDIT ACCOUNT -->
</div>

@section('scripts')
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

@stop