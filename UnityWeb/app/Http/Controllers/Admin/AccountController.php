<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Settings;
use App\Http\Requests\Account;
use App\Http\Requests\Admin\AccountEdit;
use App\Http\Controllers\Controller;
use App\Repositories\AdminRepositoryInterface;
use App\Repositories\LogRepositoryInterface;

class AccountController extends Controller {

	protected $admin;

	protected $log;

	public function __construct(AdminRepositoryInterface $admin, LogRepositoryInterface $log)
	{
		$this->middleware('auth.access:'.Settings::access()->accounts);

		$this->admin = $admin;

		$this->log = $log;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Account $request)
	{
		if ($request->get('accountid'))
		{
			$accounts = $this->admin->getAccountsById($request->get('accountid'));
		}
		elseif ($request->get('account'))
		{
			$accounts = $this->admin->filterByAccount($request->get('account'));
		}
		elseif ($request->get('email'))
		{
			$accounts = $this->admin->filterByEmail($request->get('email'));
		}
		elseif ($request->get('permissions') != '' && $request->get('privileges') != '')
		{
			$accounts = $this->admin->getAccountsByPermissionsAndPrivileges($request->get('permissions'), $request->get('privileges'));
		}
		elseif ($request->get('privileges') != '')
		{
			$accounts = $this->admin->getAccountsByPrivileges($request->get('privileges'));
		}
		elseif ($request->get('permissions') != '')
		{
			$accounts = $this->admin->getAccountsByPermissions($request->get('permissions'));
		}
		elseif ($request->get('ip') != '')
		{
			$accounts = $this->admin->filterByIp($request->get('ip'));
		}
		elseif ($request->get('mac') != '')
		{
			$accounts = $this->admin->filterByMac($request->get('mac'));
		}
		else
		{
			$accounts = $this->admin->getAccounts();
		}

		$data = [
			'accounts'	=>	$accounts
		];

		return view('admin.accounts', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if ( ! is_numeric($id) || empty($id))
		{
			return redirect()->action('Admin\AccountController@index')->with('failure', 'Id is required when editing a user.');
		}

		$account = $this->admin->getAccount($id);

		if (empty($account))
		{
			return redirect()->action('Admin\AccountController@index')->with('failure', 'Account does not exists.');
		}

		if ($account->access_level >= Auth::user()->access_level && $account->id !== Auth::user()->id)
		{
			return redirect()->action('Admin\AccountController@index')->with('failure', 'You cannot edit the account which permission is higher or same as yours.');
		}

		$data = [
			'account' => $account
		];

		return view('admin.account-edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, AccountEdit $request)
	{
		if ( ! is_numeric($id) || empty($id))
		{
			return redirect()->action('Admin\AccountController@index')->with('failure', 'Cannot update the user.');
		}

		if ($request->get('permissions') >= Auth::user()->access_level && $id != Auth::user()->id)
		{
			return redirect()->action('Admin\AccountController@index')->with('failure', 'You cannot update the account which permission is higher or same as yours.');
		}

		$account = $this->admin->getAccount($id);

		if ($account->id == Auth::user()->id && Auth::user()->access_level != $request->get('permissions'))
		{
			return redirect()->action('Admin\AccountController@index')->with('failure', 'You cannot update your permission.');
		}

		if ($account->access_level >= Auth::user()->access_level && $account->id != Auth::user()->id)
		{
			return redirect()->action('Admin\AccountController@index')->with('failure', 'You cannot edit the account which permission is higher or same as yours.');
		}

		$update = $this->admin->updateAccount($id, $request->all(), $account->access_level);

		$this->log->logAccountUpdate($account, $request->all());

		return $update ? redirect()->action('Admin\AccountController@edit', $id)->with('success', 'Account has been updated.') : redirect()->action('Admin\AccountController@edit', $id)->with('failure', 'Update account failed.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
