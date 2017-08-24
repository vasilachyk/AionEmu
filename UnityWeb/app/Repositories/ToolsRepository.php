<?php

namespace App\Repositories;

use Hash;
use App\Models\User;

class ToolsRepository implements ToolsRepositoryInterface {

	protected $model;

	public function __construct(User $model)
	{
		$this->model = $model;
	}

}