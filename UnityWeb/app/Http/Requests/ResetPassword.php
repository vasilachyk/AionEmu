<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ResetPassword extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name'		=>	['required'],
			'email'		=>	['required', 'email'],
			'token'		=>	['required', 'size:42'],
			'password'	=>	['required', 'between:4,50', 'confirmed']
		];
	}

	public function messages()
	{
		return [
			'token.size'	=>	'The token is invalid.'
		];
	}

}
