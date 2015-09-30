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
        return [
          'movement_type'   => 'required|min:1',
          'operation_type'  => 'required',
          'amount'          => 'required|numeric|min:5000',
          'wording'         => 'required|min:6',
          'cheque_number'   => 'required|alpha_dash|min:5',
          'bank'            => 'required|min:2',
        ];
    }
}
