<?php

namespace App\Http\ViewComposers;

use Request;
use Illuminate\Contracts\View\View;
use App\Repositories\PageRepositoryInterface;

class PageComposer {

	protected $page;

	public function __construct(PageRepositoryInterface $page)
	{
		$this->page = $page;
	}

	public function compose(View $view)
	{
		$view->with('dbPages', $this->page->allByStatus());
	}
}