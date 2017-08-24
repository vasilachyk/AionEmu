<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class Config extends Request {

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
			'game_port'		=>	['required', 'numeric'],
			'login_port'	=>	['required', 'numeric'],
			'timeout'		=>	['required', 'numeric'],
			'premium'		=>	['required', 'numeric'],
			'vip'			=>	['required', 'numeric'],
			'exp'			=>	['required', 'numeric'],
			'kinah'			=>	['required', 'numeric'],
			'drop'			=>	['required', 'numeric'],
			'quest'			=>	['required', 'numeric'],
			'donate_toll'	=>	['required', 'numeric'],
			'donate_times'	=>	['required', 'numeric']
		];
	}

}
