<?php

namespace Ceb\Http\Requests;

use Ceb\Http\Requests\Request;

class EditMemberRequest extends Request {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return \Sentry::check();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
	return [
		'names'   => 'required',
        'district'=>'required',
        'province'=>'required',
        'institution_id'=>'required|numeric',
        'service'=>'required',
        'termination_date'=>'date',
        // 'password'=>'required',
        'date_of_birth'=>'required|date',
        'sex'=>'required',
        'member_nid'=>'required|numeric',
        'nationality'=>'required',
        'email'=>'required|email',
        'telephone'=>'required|min:9|max:12',
        'monthly_fee'=>'required',
        'photo'=>'image',
        'signature'=>'image'
        ];
	}
}
