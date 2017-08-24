<?php

namespace App\Repositories;

use App\Models\User;

class AdminRepository implements AdminRepositoryInterface {

	protected $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	public function getAccounts($paginate = 25)
	{
		return $this->user
			->select([
				'id',
				'name',
				'access_level',
				'activated',
				'membership',
				'expire',
				'last_ip',
				'last_mac'
			])
			->paginate($paginate);
	}

	public function getAccountsById($id, $paginate = 25)
	{
		return $this->user
			->where('id', $id)
			->select([
				'id',
				'name',
				'access_level',
				'activated',
				'membership',
				'last_ip',
				'last_mac'
			])
			->paginate($paginate);
	}

	public function getAccountsByPrivileges($privileges, $paginate = 25)
	{
		return $this->user
			->where('membership', $privileges)
			->select([
				'id',
				'name',
				'access_level',
				'activated',
				'membership',
				'last_ip',
				'last_mac'
			])
			->paginate($paginate);
	}

	public function getAccountsByPermissions($permissions, $paginate = 25)
	{
		return $this->user
			->where('access_level', $permissions)
			->select([
				'id',
				'name',
				'access_level',
				'activated',
				'membership',
				'last_ip',
				'last_mac'
			])
			->paginate($paginate);
	}

	public function getAccountsByPermissionsAndPrivileges($permissions, $privileges, $paginate = 25)
	{
		return $this->user
			->where('access_level', $permissions)
			->where('membership', $privileges)
			->select([
				'id',
				'name',
				'access_level',
				'activated',
				'membership',
				'last_ip',
				'last_mac'
			])
			->paginate($paginate);
	}

	public function getAccount($id)
	{
		return $this->user
			->where('id', $id)
			->select([
				'id',
				'name',
				'access_level',
				'activated',
				'membership',
				'email',
				'toll',
				'donate_points',
				'expire',
				'last_ip',
				'last_mac'
			])->first();
	}

	public function filterByAccount($name = null, $orderBy = 'desc', $paginate = 25)
	{
		return $this->user
			->select([
				'id',
				'name',
				'access_level',
				'activated',
				'membership',
				'last_ip',
				'last_mac'
			])
			->where('name', 'like', '%'.$name.'%')
			->orderBy('id', $orderBy)
			->paginate($paginate);
	}

	public function filterByEmail($email = null, $orderBy = 'desc', $paginate = 25)
	{
		return $this->user
			->select([
				'id',
				'name',
				'access_level',
				'activated',
				'membership',
				'last_ip',
				'last_mac'
			])
			->where('email', 'like', '%'.$email.'%')
			->orderBy('id', $orderBy)
			->paginate($paginate);
	}

	public function filterByIp($ip = null, $orderBy = 'desc', $paginate = 25)
	{
		return $this->user
			->select([
				'id',
				'name',
				'access_level',
				'activated',
				'membership',
				'last_ip',
				'last_mac'
			])
			->where('last_ip', 'like', '%'.$ip.'%')
			->orderBy('id', $orderBy)
			->paginate($paginate);
	}

	public function filterByMac($mac = null, $orderBy = 'desc', $paginate = 25)
	{
		return $this->user
			->select([
				'id',
				'name',
				'access_level',
				'activated',
				'membership',
				'last_ip',
				'last_mac'
			])
			->where('last_mac', 'like', '%'.$mac.'%')
			->orderBy('id', $orderBy)
			->paginate($paginate);
	}

	public function updateAccount($id, $request, $accountPermission)
	{
		if ($request['expiry'] == '0000-00-00' || empty($request['expiry']))
		{
			$expiry = NULL;
		}
		else
		{
			$expiry = $request['expiry'];
		}

		return $this->user
			->where('id', $id)
			->update([
				'access_level'	=>	$request['permissions'] == -1 ? $accountPermission : $request['permissions'],
				'activated'		=>	$request['status'],
				'membership'	=>	$request['privileges'],
				'email'			=>	$request['email'],
				'toll'			=>	$request['toll'],
				'donate_points'	=>	$request['credit_points'],
				'expire'		=>	$expiry
			]);
	}
}