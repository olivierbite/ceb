<?php

namespace Ceb\Http\Requests;

use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Ceb\Factories\LoanFactory;
use Ceb\Http\Requests\Request;
use Ceb\Models\Setting;
use Ceb\Models\User;


class CompleteLoanRequest extends Request
{
    /**
     * @var Ceb\Factories\LoanFactory
     */
    protected $loanFactory;

    function __construct(LoanFactory $loanFactory,User $member,Setting $setting) {
        $this->loanFactory = $loanFactory;
        $this->member = $member;
        $this->setting = $setting;
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

        $attributes = parent::all();
        $rightToLoan = 0 ;
        
        $member = $this->member->findByAdhersion($attributes['adhersion_id']);

        if (!is_null($member)) {
          $rightToLoan = $member->right_to_loan;
        }

        // Validate the right to loan
        $settingKey = strtolower($attributes['operation_type']).'.amount';
        if ($this->setting->hasKey($settingKey) !== false) {
           $rightToLoan = $this->setting->keyValue($settingKey);
        }
      
      $validations = [
          'operation_type'    =>  'required|min:3',
          'loan_to_repay'     =>  'required|numeric|max:'.$rightToLoan,
          'wording'           =>  'required|min:6',
          'cheque_number'     =>  'required|alpha_dash|min:5',
          'bank'              =>  'required|min:1',
          'accounting_amount' =>  'required|confirmed|numeric|min:'.parent::get('amount'),
          'loanaccountamount' =>  'required|confirmed|numeric',
          'cautionneur'       =>  'confirmed',
          'accounts'          =>  'confirmed',
        ];

      // if this loan is social loan, make sure the user has selected a reason
      if (strtolower($attributes['operation_type']) == 'social_loan') {
        $validations['reason']  =  'required|min:3';
      }

        //Continue with Rule validation
        return $validations; 
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

        // Set the member by his adhersion ID
        $member = $this->member->findByAdhersion($attributes['adhersion_id']);

        if (!is_null($member)) { 
          $this->loanFactory->addMember($member->id);
        }

        // Modify or Add new array key/values
        // ==================================
        // Make sure these fields are numeric
         $attributes['loan_to_repay']  = intval($attributes['loan_to_repay']) ;

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
        
        // Validate bonded amount
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
        
        // Format/sanitize data here
        return $attributes;
    }
}