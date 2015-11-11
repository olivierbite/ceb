<?php

namespace Ceb\Http\Requests;

use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Ceb\Factories\LoanFactory;
use Ceb\Http\Requests\Request;
use Ceb\Models\User;

class RegularisationRequest extends Request
{
   /**
     * @var Ceb\Factories\LoanFactory
     */
    protected $loanFactory;

    function __construct(LoanFactory $loanFactory,User $member) {
        $this->loanFactory = $loanFactory;
        $this->member = $member;
    }

    public function authorize()
    {
        return Sentry::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $attributes = parent::all();

        $rightToLoan = 0 ;
        $member      = null;

        if (isset($attributes['adhersion_id'])) {
          $member = $this->member->findByAdhersion($attributes['adhersion_id']);
        }

        if (!is_null($member)) {
          $rightToLoan = $member->more_right_to_loan_amount;
        }


      $validations = [
          'adhersion_id'          =>  'required|min:4',
          'loan_id'               =>  'required|numeric',
          'regularisationType'    =>  'required|min:3',
          'wording'               =>  'required|min:6',
        ];
      
       /**
       * If this regularisation needs to deal with installments
       */
       if (strpos(strtolower($attributes['regularisationType']), 'installments')  !== false ) { 
          $validations['additional_installments'] = 'required|numeric|min:1';
       }

      /**
       * If this regularisation needs to deal with money
       */
      if (strpos(strtolower($attributes['regularisationType']), 'amount')  !== false ) { 
        $validations['loan_to_repay']         =  'required|numeric|max:'.$rightToLoan;
        $validations['cheque_number']         =  'required|alpha_dash|min:5';
        $validations['bank']                  =  'required|min:1';
        $validations['accounting_amount']     =  'required|confirmed|numeric|min:'.parent::get('amount');
        $validations['loanaccountamount']     =  'required|confirmed|numeric';
        $validations['accounts']              =  'confirmed';
      }

      //Continue with Rule validation
      return  $validations;
    }

    /**
     * Modifying input before validation
     * @return array
     */
    public function all()
    {
        // Grab all inputs from the user
        $attributes = parent::all();

        // Continue only if the method is get 
         if ($this->isMethod('get')) {
           return $attributes;
        }

        /** We don't have to continue if regularisation type is installment */
        if ($attributes['regularisationType'] == 'installments') {
            return $attributes;
        }


        // Modify or Add new array key/values
        // ==================================
        // Make sure these fields are numeric
         $attributes['loan_to_repay']  = intval($attributes['loan_to_repay']) ;

         if ($attributes['loan_to_repay'] > 0 ) {
            // Validating account amount
            $attributes['accounting_amount'] = array_sum($attributes['debit_amounts']);
            $attributes['accounting_amount_confirmation'] = array_sum($attributes['credit_amounts']);
            
            // Validate total amount vs Account amount   
            $attributes['loanaccountamount'] = $attributes['loan_to_repay'];
            $attributes['loanaccountamount_confirmation'] = $attributes['accounting_amount_confirmation'];

            // Validate bank
            $attributes['bank'] = $attributes['bank_id'];
        
         

            // Validate the input accounts 
            $accounts = array_intersect($attributes['credit_accounts'], $attributes['debit_accounts']);
            if (count($accounts) > 0) {    
                $attributes['accounts']              = count($accounts);
                $attributes['accounts_confirmation'] = 0;
            }
        }

        // Format/sanitize data here
        return $attributes;
    }
}
