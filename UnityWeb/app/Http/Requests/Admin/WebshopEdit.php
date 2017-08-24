<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use Illuminate\Contracts\Foundation\Application;
use App\Repositories\WebshopCategoryRepositoryInterface;

class WebshopEdit extends Request {

	protected $connection = 'aionls';

	protected $webshopCategory;

	public function __construct(WebshopCategoryRepositoryInterface $webshopCategory, Application $app)
	{
		$verifier = $app->make('validation.presence');
		$verifier->setConnection($this->connection);

		$this->webshopCategory = $webshopCategory;
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

		$ids = [];

		$categories = $this->webshopCategory->getByStatus(0);

		foreach ($categories as $category)
		{
			$ids[] = $category->id;
		}

		$resultIds = implode(',', $ids);

		return [
			// 'itemid'		=> ['required', 'unique:cms_webshop,item_id,'. $id. ',item_id', 'integer'],
			'itemid'		=> ['required', 'integer'],
			'level'			=> ['required', 'integer'],
			'name'			=> ['required'],
			'amount'		=> ['required', 'integer'],
			'price'			=> ['required', 'integer'],
			'enchant'		=> ['required', 'integer'],
			'temperance'	=> ['required', 'integer'],
			'category'		=> ['required', 'in:'. $resultIds],
            'image_id'      => ['required'],
            'type'          => ['required'],
		];
	}

}
