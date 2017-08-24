<?php

namespace App\Http\ViewComposers;

use Request;
use Illuminate\Contracts\View\View;
use App\Repositories\MembershipRepositoryInterface;

class AdminMembershipComposer {

	protected $membership;

	public function __construct(MembershipRepositoryInterface $membership)
	{
		$this->membership = $membership;
	}

	public function compose(View $view)
	{
		$view->with('memberships', $this->membership->get());
	}
}