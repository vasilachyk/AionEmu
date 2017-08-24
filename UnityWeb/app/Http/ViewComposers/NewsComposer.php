<?php

namespace App\Http\ViewComposers;

use Request;
use Settings;
use Illuminate\Contracts\View\View;
use App\Repositories\NewsRepositoryInterface;

class NewsComposer {

	protected $news;

	public function __construct(NewsRepositoryInterface $news)
	{
		$this->news = $news;
	}

	public function compose(View $view)
	{
		$view->with('news', $this->news->show(Settings::general()->news_count));
	}
}