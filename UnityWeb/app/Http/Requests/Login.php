<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Contracts\Foundation\Application;

class Login extends Request {

	protected $connection = 'aionls';

	protected $redirectAction = 'Auth\AuthController@getLogin';

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
			'name'	=>	['required'],
			'password'	=> ['required']
		];
	}

}
