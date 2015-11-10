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

        // Only validate for other method other than get
        if ($this->isMethod('get')) {
           return [];
        }
     
      //Continue with Rule validation
        return [
          'operation_type'    =>  'required|min:3',
          'loan_to_repay'     =>  'required|numeric|min:5000',
          'wording'           =>  'required|min:6',
          'cheque_number'     =>  'required|alpha_dash|min:5',
          'bank'              =>  'required|min:1',
          'accounting_amount' =>  'required|confirmed|numeric|min:'.parent::get('amount'),
          'loanaccountamount' =>  'required|confirmed|numeric',
          'cautionneur'       =>  'confirmed',
          'accounts'          =>  'confirmed',
        ];
    }

    /**
     * Modifying input before validation
     * @return array
     */
    public function all()
    {
        // Grab all inputs from the user
        $attributes = parent::all();

        dd($attributes);
        // Continue only if the method is get 
         if ($this->isMethod('get')) {
           return $attributes;
        }

        /** We don't have to continue if regularisation type is installment */
        if ($attributes['regularisationType'] == 'installments') {
            return $attributes;
        }

        // Set the member by his adhersion ID
        $memberId = $this->member->findByAdhersion($attributes['adhersion_id'])->id;

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

        // Validate bonded amount
        if (isset($attributes['amount_bonded'])) {
        
        $bondedAmount = (int) $attributes['amount_bonded'];
        $contributions = (int) str_replace(',', '', $attributes['member']['contributions']);

        // If we have bonded amount then check if we have cautionneur
        // If the amount to repay is higher than total contributions  
        // we need to have a cautionneur
        if (!empty($bondedAmount) && ($attributes['loan_to_repay'] > $contributions )) {
            // If we have bonded amount make sure we fail this transacation            
            $cautionneur = $this->loanFactory->getCautionneurs();

            //  We can only allow two cautionneurs if they are not set 
            //  We will fail this validation
            if (count($cautionneur) !== 2) {
                 $attributes['cautionneur']                 = 'cautionneur';
                 $attributes['cautionneur_confirmation']    = 'cautionneur_to_faile';
            }
        }else{
          $attributes['amount_bonded'] = 0;
        }

        }
        // Format/sanitize data here
        return $attributes;
    }
}
