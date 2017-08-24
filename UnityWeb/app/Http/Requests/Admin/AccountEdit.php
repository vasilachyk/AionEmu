<?php

namespace App\Http\Requests\Admin;

use Auth;
use App\Http\Requests\Request;

class AccountEdit extends Request {

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
		if (Auth::user()->access_level >= 5)
		{
			return [
				'permissions'	=>	['numeric', 'in:-1,0,1,2,3,4,5,6,7,8,9,10'],
				'privileges'	=>	['numeric', 'in:0,1,2'],
				'status'		=>	['numeric', 'in:0,1'],
				'email'			=>	['email'],
				'toll'			=>	['numeric'],
				'donate_points'	=>	['numeric']
			];
		}
		else
		{
			return [
				'permissions'	=>	['numeric', 'in:0,1,2,3,4,5'],
				'privileges'	=>	['numeric', 'in:0,1,2'],
				'status'		=>	['numeric', 'in:0,1'],
				'email'			=>	['required', 'email'],
				'toll'			=>	['numeric'],
				'donate_points'	=>	['numeric']
			];
		}
	}
}
