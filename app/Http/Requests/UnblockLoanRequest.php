<?php

namespace Ceb\Http\Requests;

use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Ceb\Factories\LoanFactory;
use Ceb\Http\Requests\Request;
use Ceb\Models\Setting;
use Ceb\Models\User;


class UnblockLoanRequest extends Request
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
      if ($this->isMethod('get')) {
           return [];
        }
      return [
              'cheque_number'     =>  'required|alpha_dash|min:5',
              'bank_id'           =>  'required|min:1',
              'cautionneur'       =>  'confirmed',
              'loanid'            =>  'required|numeric',
              ];
       
    }

   
    public function all()
    {
        $attributes = parent::all();

        $attributes['amount_bonded'] = isset($attributes['amount_bonded'])?$attributes['amount_bonded']:0;
        $bondedAmount = (int) $attributes['amount_bonded'];
        
        // If we have bonded amount then check if we have cautionneur
        // If the amount to repay is higher than total contributions  
        // we need to have a cautionneur
        if (!empty($bondedAmount)) {
            // If we have bonded amount make sure we fail this transacation            
            $cautionneur = $this->loanFactory->getCautionneurs();
            //  We can only allow two cautionneurs if they are not set 
            //  We will fail this validation
            if (count($cautionneur) !== 2) {
                 $attributes['cautionneur']                 = 'cautionneur';
                 $attributes['cautionneur_confirmation']    = 'cautionneur_to_faile';
            }
        }
      return  array_change_key_case(parent::all(),CASE_LOWER);
    }
}
