<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class Purchase extends Request {

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
			'itemid'	=>	['required', 'numeric'],
			'player'	=>	['required', 'numeric', 'not_in:-1']
		];
	}

	public function messages()
	{
		return [
			'itemid.required'	=>	'The selected item is invalid.',
			'itemid.numeric'	=>	'The selected item is invalid.',
			'player.required'	=>	'The selected character does not exists.',
			'plater.numeric'	=>	'The selected character does not exists.'
		];
	}

}
