<?php

namespace App\Http\ViewComposers;

use Request;
use Illuminate\Contracts\View\View;
use App\Repositories\NewsCategoryRepositoryInterface;

class NewsCategoryComposer {

	protected $category;

	public function __construct(NewsCategoryRepositoryInterface $category)
	{
		$this->category = $category;
	}

	public function compose(View $view)
	{
		$view->with('newsCat', $this->category->get());
	}
}