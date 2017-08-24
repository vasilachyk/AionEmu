<?php

namespace App\Http\ViewComposers;

use Request;
use Illuminate\Contracts\View\View;
use App\Repositories\CmsConfigRepositoryInterface;

class ConfigComposer {

	protected $config;

	public function __construct(CmsConfigRepositoryInterface $config)
	{
		$this->config = $config;
	}

	public function compose(View $view)
	{
		$view->with('config', $this->config->get());
	}
}