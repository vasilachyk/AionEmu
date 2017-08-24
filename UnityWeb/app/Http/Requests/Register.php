<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Contracts\Foundation\Application;

class Register extends Request {

	protected $connection = 'aionls';

	public function __construct(Application $app)
	{
		$verifier = $app->make('validation.presence');
		$verifier->setConnection($this->connection);
	}
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
			'username'				=>	['required', 'between:4,50', 'unique:account_data,name'],
			'password'				=>	['required', 'between:4,50', 'confirmed'],
			'email'					=>	['required', 'email', 'unique:account_data,email'],
		];
	}

}
