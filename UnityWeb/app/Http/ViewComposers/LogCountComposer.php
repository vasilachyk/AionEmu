<?php

namespace App\Http\ViewComposers;

use Request;
use Illuminate\Contracts\View\View;
use App\Repositories\LogRepositoryInterface;

class LogCountComposer {

	protected $log;

	public function __construct(LogRepositoryInterface $log)
	{
		$this->log = $log;
	}

	public function compose(View $view)
	{
		$view->with('webshopCount', $this->log->getWebshopUnreadCount());

		$view->with('donateCount', $this->log->getDonateUnreadCount());

		$view->with('membershipCount', $this->log->getMembershipUnreadCount());

		$view->with('accountUpdatesCount', $this->log->getAccountUpdatesCount());

		$view->with('logToolsSendItemCount', $this->log->getLogToolsSendItemUnreadCount());
	}
}