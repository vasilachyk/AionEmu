<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PageRepositoryInterface;

class PageController extends Controller {

	protected $page;

	public function __construct(PageRepositoryInterface $page)
	{
		$this->page = $page;
	}

	public function getPage($slug = null)
	{
		$page = $this->page->findBySlug($slug);

		if (empty($page)) abort(404, 'Page not found.');

		$data = [
			'page'	=> $page
		];

		return view('pages.main.page', $data);
	}

}
