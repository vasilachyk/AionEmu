<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\NewsRepositoryInterface;

class NewsController extends Controller {

	protected $news;

	public function __construct(NewsRepositoryInterface $news)
	{
		$this->news = $news;
	}

	public function getIndex()
	{
		$data = [
			'news'	=>	$this->news->all()
		];

		return view('pages.news.index', $data);
	}

	public function getNews($id = null, $slug = null)
	{
		if (empty($id && $slug)) return redirect()->action('HomeController@index');

		$news = $this->news->findWithSlug($id, $slug);

		if (empty($news)) return redirect()->action('HomeController@index');

		$data = [
			'news'	=>	$news
		];

		return view('pages.news.show', $data);
	}

}
