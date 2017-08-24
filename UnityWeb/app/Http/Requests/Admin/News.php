<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use App\Repositories\NewsCategoryRepositoryInterface;

class News extends Request {

	protected $category;

	public function __construct(NewsCategoryRepositoryInterface $category)
	{
		$this->category = $category;
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
		$ids = [];

		$categories = $this->category->get();

		foreach ($categories as $category)
		{
			$ids[] = $category->id;
		}

		$resultIds = implode(',', $ids);

		return [
			'title'		=>	['required'],
			'slug'		=>	['required'],
			'category'	=>	['required', 'numeric', 'in:'.$resultIds],
			'content'	=>	['required']
		];
	}

}
