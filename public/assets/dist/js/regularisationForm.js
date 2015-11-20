jQuery(document).ready(function($) {

	 // Global variables
 	var data = {};
	/** START BY CALCULATING LOAN DETAILS */
	calculateLoanDetails();

  	/** SET Operation type if it is changed */
  	$("#operation_type").change(function(event) {
  		var loanType = $(this);
  		window.location.href = window.location.protocol+'//'+window.location.host+'/regularisation'+'?operation_type='+loanType.val();
  	});

	
	function calculateLoanDetails(){

		// Remove any character that is not a number
		var additional_amount		= 0;
		var loanBalance				= 0;
		var additional_installments	= 0;
		var remaining_installments	= 0;
		var totalContributions		= 0;
		var additinal_charges_rate	= 0;
		var additinal_charges		= 0;

		if(typeof $('#additional_amount').val() !=='undefined'){
	        additional_amount =$('#additional_amount').val().replace(/,/g,''); 
	    }
		if(typeof $('#loanBalance').val() !=='undefined'){
	        loanBalance =$('#loanBalance').val().replace(/,/g,'');
	    }
		if(typeof $('#numberOfInstallment').val() !=='undefined'){
	        additional_installments =$('#numberOfInstallment').val();
	    }
		if(typeof $('.remaining_tranches').val() !=='undefined'){
	        remaining_installments =$('.remaining_tranches').val().replace(/,/g,'');
	    }
		// Remove any character that is not a number
		if(typeof $('#totalContributions').val() !=='undefined'){
	        totalContributions =$('#totalContributions').val().replace(/,/g,''); 
	    }
		if(typeof $('.additinal_charges_rate').val() !=='undefined'){
	        additinal_charges_rate =$('.additinal_charges_rate').val().replace(/,/g,''); 
	    }

	    additional_amount 		= parseInt(additional_amount);
		loanToRepay				= parseInt(additional_amount);
		numberOfInstallment		= parseInt(additional_installments) + parseInt(remaining_installments);
		interestRate			= parseFloat(getInterestRate(numberOfInstallment));
		additinal_charges_rate	= parseInt(additinal_charges_rate);

		if (loanToRepay == 0) {
			loanToRepay +=parseInt(loanBalance);
		};

		// Interest formular
		// =================
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
		var operation_type  	= $('#operation_type').val();
		var additinal_charges	= additional_amount * (additinal_charges_rate / 100);
		var netToReceive		= additional_amount - additinal_charges;
		loanToRepay				= loanToRepay + interests + additinal_charges;

		// Update fields		
		$('#interests').val(Math.round(interests) );
		data[$('#interests').attr('name')] = $('#interests').val();
    	$('#monthlyInstallments').val(Math.round((loanToRepay/numberOfInstallment)) );

        // If this regularisation has to pay additinal charges, then calculate administration fees
		// And remove it from the net_to_receive
		$('#additinal_charges').val(parseInt(additinal_charges));
		$('#netToReceive').val(parseInt(netToReceive - additinal_charges ));
		$('#loanToRepay').val(parseInt(loanToRepay));
		$('#new_installments').val(numberOfInstallment);
  		
  		// If the amount to repay is less or equal to the 
  		// User total contributions then there is no 
  		// need to the caution then hide the form
  		
  		if(parseInt(loanToRepay) <= parseInt(totalContributions)){
  			$('#cautionForm').css('display', 'none');
  		}else{
  			$('#cautionForm').css('display','block');

  			// Since the form is shown, let's check the data we should 
  			// Put in the form
  			 $('#amount_bonded').val(parseInt(loanToRepay - totalContributions));
			// Amount bonded or cautionnee 
			// the amount sanctioned is equal to the excess not guaranteed by
			// saving the borrower shared equally between the two Cautionneurs.
			if($('#amount_bonded').val() == ""){
				$('#amount_bonded').val(parseInt($('#netToReceive').val())/2);
			};

  		}

	}

	/**
	 * De 1 à 12 mois le taux d’intérêt est de 3.4
	 * De 13 à 24 mois le taux d’intérêt est de 3.6
	 * De 25 à 36 mois le taux d’intérêt est de 4.1
	 * De 37 à 48 mois le taux d’intérêts est de 4.3
	 * @return  {[type]} [description]
	 */
	function getInterestRate(numberOfInstallment){

			if (numberOfInstallment>=1 && numberOfInstallment<=12) {return 3.4;};
			if (numberOfInstallment>=13 && numberOfInstallment<=24) {return 3.6;};
			if (numberOfInstallment>=25 && numberOfInstallment<=36) {return 4.1;};
			if (numberOfInstallment>=37 && numberOfInstallment<=48) {return 4.3;};
			if (numberOfInstallment>=49 && numberOfInstallment<=60) {return 4.8;};
			if (numberOfInstallment>=61 && numberOfInstallment<=72) {return 5;};
	}

   $('.search-cautionneur').click(function(event) {
    	// Prevent the default event action 
    	event.preventDefault();
    	var cautionneur = $(this).parent().find('input');
    	
    	// Check if this input has at least some data
    	if(cautionneur.val() !== "")
    	{
    		var segments = window.location.pathname.split( '/' );

			window.location.href = window.location.protocol+'//'+window.location.host+'/regularisation/setcautionneur'+'?'+cautionneur.attr('name')+'='+cautionneur.val();		
    		return true;
    	}

    	// If we reach here it means we have nothing to do, just return false
    	return false;
      });


	// Detect if an input has been written in 
	$('.loan-input').keyup(function(event) {
		updateInput($(this));
	});	

	// Detect if an input has been written in 
	$('.loan-select').change(function(event) {
		/* First get current input data */
		var data = {};	
		// Make sure you send request when 
		// We only have something in the input
		if ($(this).val()) {
		    data[$(this).attr('name')] = $(this).val();
			setTimeout(updateField(data), 5000);
		};
		calculateLoanDetails();
	});		

	function updateInput (element) {
		/* First get current input data */
		var fieldName = element.attr('name');
        var fieldValue = element.val();
      
		// Validate if this input is wished amount
		// wished amount should not be higher than right to loan
		if(fieldName == 'wished_amount'){
			isValidWishedAmount();
		}
		// Check this is empty then set it to sezo
		if (fieldValue == "") {
			element.val(0);
		};
		// Make sure you send request when 
		// We only have something in the input
		if (element.val()) {
		    data[fieldName] = element.val();
			setTimeout(updateField(data), 5000);
		};
        
		// Update calculations
		calculateLoanDetails();
	}
   	/**
	 * Update loan input field on the server side
	 * @param    json array data data to be sent to the server
	*/
	function updateField(formData,requestUrl){

		/** first calculate existings fields */
		calculateLoanDetails();
		/** If the requestUrl was not initialized then set default to ajax/loan */
		requestUrl = typeof requestUrl!=='undefined' ? requestUrl :'/ajax/regularisation';

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