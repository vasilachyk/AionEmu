<?php

namespace App\Http\ViewComposers;

use Request;
use Illuminate\Contracts\View\View;
use App\Repositories\WebshopCategoryRepositoryInterface;

class WebshopCategoryComposer {

	protected $webshop;

	public function __construct(WebshopCategoryRepositoryInterface $webshop)
	{
		$this->webshop = $webshop;
	}

	public function compose(View $view)
	{
		$view->with('shopCategory', $this->webshop->getByStatus());
	}
}