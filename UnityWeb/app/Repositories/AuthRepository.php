<?php

namespace App\Repositories;

use Hash;
use Carbon;
use App\Models\User;

class AuthRepository implements AuthRepositoryInterface {

	protected $model;

	public function __construct(User $model)
	{
		$this->model = $model;
	}

	public function register($request)
	{
		return $this->model->create([
			'name'			=>	$request['username'],
			'password'		=>	Hash::make($request['password']),
			'email'			=>	$request['email'],
			'created_at'	=>	Carbon::now()
		]);
	}
}