<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use Illuminate\Contracts\Foundation\Application;

class NewsCategoryEdit extends Request {

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
		$id = $this->segment(3);

		return [
			'title'		=>	['required'],
			'slug'		=>	['required', 'unique:cms_news_category,slug,'. $id],
			'status'	=>	['required', 'in:0,1']
		];
	}

}
