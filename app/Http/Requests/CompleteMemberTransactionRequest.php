<?php

namespace Ceb\Http\Requests;

use Ceb\Http\Requests\Request;
use Sentry;
class CompleteMemberTransactionRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
     

      //Continue with Rule validation
        return [
          'movement_type'    =>  'required|numeric|min:1',
          'operation_type'   =>  'required',
          'amount'           =>  'required|numeric|min:5000',
          'wording'          =>  'required|min:6',
          'cheque_number'    =>  'required|alpha_dash|min:5',
          'bank'             =>  'required|min:1',
          'accounting_amount' => 'required|confirmed|numeric|min:'.parent::get('amount'),
          'transactionamount' => 'required|confirmed|numeric',
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
       
        // Modify or Add new array key/values
        // ==================================
        
        // Make sure these fields are numeric
         $attributes['movement_type'] = intval($attributes['movement_type']);
         $attributes['amount']  = intval($attributes['amount']) ;

        // Validating account amount
        $attributes['accounting_amount'] = array_sum($attributes['debit_amounts']);
        $attributes['accounting_amount_confirmation'] = array_sum($attributes['credit_amounts']);
        
        // Validate total amount vs Account amount   
        $attributes['transactionamount'] = $attributes['amount'];
        $attributes['transactionamount_confirmation'] = $attributes['accounting_amount_confirmation'];

        // Format/sanitize data here
        return $attributes;
    }
}
