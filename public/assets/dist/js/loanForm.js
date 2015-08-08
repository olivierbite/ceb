jQuery(document).ready(function($) {

 	 // Global variables
 	var data = {};
    var notification = '<div class="alert alert-danger">';
    notification +='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
    notification +='message';
    notification +='</div>';
    
  
	// Make sure that only number are entered in the box
	$("input.loan-input").numeric();
	$(".search-cautionneur").parent().find('input').numeric();

	// Detect if an input has been written in 
	$('.loan-input').keyup(function(event) {

		/* First get current input data */
		var fieldName = $(this).attr('name');
        var fieldValue = $(this).val();
      
		// Validate if this input is wished amount
		// wished amount should not be higher than right to loan
		if(fieldName == 'wished_amount'){
			isValidWishedAmount();
		}
		// Check this is empty then set it to sezo
		if (fieldValue == "") {
			$(this).val(0);
		};
		// Make sure you send request when 
		// We only have something in the input
		if ($(this).val()) {
		    data[fieldName] = $(this).val();
			setTimeout(updateField(data), 5000);
		};
        
		// Update calculations
		calculateLoanDetails();
	});	

	// Detect if an input has been written in 
	$('.loan-select').change(function(event) {
		/* First get current input data */
		var data = {};	
		// Make sure you send request when 
		// We only have something in the input
		if ($(this).val()) {
			console.log($(this).attr('name'));
		    data[$(this).attr('name')] = $(this).val();
			setTimeout(updateField(data), 5000);
		};
		calculateUrgentLoanFees();
	});				

	isValidWishedAmount();

	// If wished amount doesn't have anything
	// then set the default to be the same as the 
	// right to loan
	if($('#wished_amount').val() == "" || $('#wished_amount').val() == "0"){
	 $('#wished_amount').val($('#rightToLoan').val().replace(/,/g,''));
	};

	// If loan to repay is less or equal to the total contribution 
	// Then hide the caution form
  	if(parseInt(loanToRepay) <= parseInt(totalContributions)){
  		console.log('just testing');
		$('#cautionForm').css('display', 'none');
	}else{
		$('#cautionForm').css('display', 'show');;
	};




	// if the loan to pay amount is null or 
	// doesn't have anything then set it to default
	// which is equal to wished amount
	if($('#loanToRepay').val()=="" || $('#loanToRepay').val()=="0"){
	  $('#loanToRepay').val($('#wished_amount').val());
	 };
	 var loanToRepay =  parseFloat($('#loanToRepay').val());
	 var totalContributions = parseFloat($('#totalContributions').val());

	 $('#amount_bonded').val(loanToRepay - totalContributions);

	// Amount bonded or cautionnee 
	// the amount sanctioned is equal to the excess not guaranteed by
	// saving the borrower shared equally between the two Cautionneurs.
	if($('#amount_bonded').val() == ""){
		$('#amount_bonded').val(parseInt($('#netToReceive').val())/2);
	};


	calculateLoanDetails();
	calculateUrgentLoanFees();

	function calculateLoanDetails(){
		var loanToRepay = $('#loanToRepay').val();
		var interestRate  = getInterestRate();
		var totalContributions = $('#totalContributions').val().replace(/,/g,''); // Remove any character that is not a number
		var numberOfInstallment = $('#numberOfInstallment').val();

		// Interest formular
		// The formular to calculate interests at ceb is as following
		// I =  P *(TI * N)
		//     ------------
		//     1200 + (TI*N)
		//
		// Where :   I : Interest 
		//           P : Amount to Repay
		//           TI: Interest Rate
		//           N : Montly payment
		// LoanToRepay * (InterestRate*NumberOfInstallment) / 1200 +(InterestRate*NumberOfInstallment)
		
		var interests = (loanToRepay * (interestRate*numberOfInstallment)) / (1200 +(interestRate*numberOfInstallment));
		var netToReceive = loanToRepay - interests;
		
		// Update fields		
		$('#interests').val(Math.round(interests) );
		data[$('#interests').attr('name')] = $('#interests').val();

		$('#netToReceive').val(Math.round(netToReceive) );
		data[$('#netToReceive').attr('name')] = $('#netToReceive').val();
        
    	$('#monthlyInstallments').val(Math.round((loanToRepay/numberOfInstallment)) );
  		
  		// If the amount to repay is less or equal to the 
  		// User total contributions then there is no 
  		// need to the caution then hide the form
  		// 
  	     console.log(parseInt(loanToRepay) <= parseInt(totalContributions));
  		if(parseInt(loanToRepay) <= parseInt(totalContributions)){
  			$('#cautionForm').css('display', 'none');
  		}else{
  			$('#cautionForm').css('display','block');

  			// Since the form is shown, let's check the data we should 
  			// Put in the form
  			 $('#amount_bonded').val(loanToRepay - totalContributions);
			// Amount bonded or cautionnee 
			// the amount sanctioned is equal to the excess not guaranteed by
			// saving the borrower shared equally between the two Cautionneurs.
			if($('#amount_bonded').val() == ""){
				$('#amount_bonded').val(parseInt($('#netToReceive').val())/2);
			};

  		}

	}

	function calculateUrgentLoanFees(){
		if ($('#operation_type').val()=='urgent_ordinary_loan') {
			if (loanToRepay > 0 ) {
				$('#interest_on_urgently_loan').val(Math.round((loanToRepay*.02)) );
			};
			$('#interest_on_urgently_loan').val(0);
			return true;
		};
		$('#interest_on_urgently_loan').val(0);
	}
	/**
	 * De 1 à 12 mois le taux d’intérêt est de 3.4
	 *De 13 à 24 mois le taux d’intérêt est de 3.6
	 *De 25 à 36 mois le taux d’intérêt est de 4.1
	 *De 37 à 48 mois le taux d’intérêts est de 4.3
	 * @return {[type]} [description]
	 */
	function getInterestRate(){
		var numberOfInstallment = $('#numberOfInstallment').val();

		if (numberOfInstallment>0 && numberOfInstallment<=12) {return 3.4;};
		if (numberOfInstallment>12 && numberOfInstallment<=24) {return 3.6;};
		if (numberOfInstallment>24 && numberOfInstallment<=36) {return 4.1;};
		if (numberOfInstallment>36 && numberOfInstallment<=48) {return 4.3;};
	}
	/**
	 * If the wished amount is higher than the
	 * amount in the right to loan then dipsly error
	 */
    function isValidWishedAmount(){
      var rightToLoanAmount = $('#rightToLoan').val().replace(/,/g,'');
      rightToLoanAmount = parseInt(rightToLoanAmount);

      var wishedAmount 	  = parseInt($('#wished_amount').val());

      if(wishedAmount > rightToLoanAmount){
		    notification = notification.replace('message','Wished amount has to be less or equal to Right to loan');
			$('.loan-notifications').html(notification);
			$('#wished_amount').addClass('has-error');
			$('#wished_amount').val(rightToLoanAmount);
			return false;
		}
		// For us to reach here
		// All is good ! time to sleep
		$('.loan-notifications').html('');
		$('#wished_amount').removeClass('has-error');

		return true;
    }
    $('.search-cautionneur').click(function(event) {
    	// Prevent the default event action 
    	event.preventDefault();
    	var cautionneur = $(this).parent().find('input');
    	
    	// Check if this input has at least some data
    	if(cautionneur.val() !== ""){
			window.location.href = window.location.protocol+'//'+window.location.host+'/loans/setcautionneur'+'?'+cautionneur.attr('name')+'='+cautionneur.val();
    		
    		return true;
    	}

    	// If we reach here it means we have nothing to do, just return false
    	return false;
      });

     //If the letter date is determined
     //Let's check if this loan is oridinary loan
     //or a loan with ordinary urgent loan
     //Oridinary loan is detected when someone's letter date is after 15 of each month
     
   	 $("input[name='letter_date']").on('click keyup keydown keypress change',function(event) {
   	 	event.preventDefault();
   	   	validateOrdinaryLoan($(this));
   	   });
   	 $('html').click(function(e) {
  //if clicked element is not your element and parents aren't your div
		  if (e.target.id != 'date' && $(e.target).parents('#date').length == 0) {
		  validateOrdinaryLoan($("input[name='letter_date']"));

		  }
	 });
	
	/**
   	  * Determine if this loan is urgent or not
   	  * @param  letterdate object this 
   	  * @return mixed    
   	  */
   	function validateOrdinaryLoan(element){
   		var letterDate = new Date(element.val());
   		calculateUrgentLoanFees();
   	   	if (letterDate.getDate() > 15) {
   	   		$('#operation_type').val('urgent_ordinary_loan');
   	   		return ;
   	   	};
   	   	$('#operation_type').val('ordinary_loan');
   	}
   	/**
	 * Update loan input field on the server side
	 * @param  json array data data to be sent to the server
	*/
	function updateField(formData,requestUrl){

		/** first calculate existings fields */
		calculateLoanDetails();
		/** If the requestUrl was not initialized then set default to ajax/loan */
		requestUrl = typeof requestUrl!=='undefined' ? requestUrl :'/ajax/loans';

		$.ajax({
			url: requestUrl,
			type: 'GET',
			async: true,	
			data: formData,
		})
		.done(function(data) {

		})
		.fail(function(error) {
			console.log("error "+error);
		})
		.always(function() {
		});			
	}
});