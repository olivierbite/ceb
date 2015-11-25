<?php

namespace Ceb\Http\Requests;

use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Ceb\Http\Requests\Request;


class UnblockLoanRequest extends Request
{

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
              'loanid'            => 'required|numeric',
              ];
       
    }

   
    public function all()
    {
      return  array_change_key_case(parent::all(),CASE_LOWER);
    }
}
