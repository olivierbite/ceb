d<?php

namespace Ceb\Http\Requests;

use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Ceb\Http\Requests\Request;


class CompleteLoanRequest extends Request
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

      return [
              'cheque_number'     =>  'required|alpha_dash|min:5',
              'bank'              =>  'required|min:1',
              ];
       
    }

   
}
