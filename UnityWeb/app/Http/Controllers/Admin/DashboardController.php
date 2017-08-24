<?php

namespace App\Http\Controllers\Admin;

use Settings;
use App\Http\Requests\Account;
use App\Http\Controllers\Controller;
use App\Repositories\AdminRepositoryInterface;

class DashboardController extends Controller {

	protected $admin;

	public function __construct(AdminRepositoryInterface $admin)
	{
		$this->middleware('auth.access:'.Settings::access()->dashboard);

		$this->admin = $admin;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		return view('admin.dashboard');
	}
}
