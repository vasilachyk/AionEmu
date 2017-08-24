<?php

namespace App\Repositories;

use App\Models\WebshopCategory;

class WebshopCategoryRepository implements WebshopCategoryRepositoryInterface {

	protected $model;

	public function __construct(WebshopCategory $model)
	{
		$this->model = $model;
	}

	public function getAll($paginate = 20)
	{
		return $this->model->paginate($paginate);
	}

	public function get($id)
	{
		return $this->model
			->where('id', $id)
			->first();
	}

	public function findBySlug($slug)
	{
		return $this->model
			->where('slug', $slug)
			->where('status', 1)
			->first();
	}

	public function getByStatus($status = 1)
	{
		if ($status == 1)
		{
			return $this->model
				->where('status', $status)
				->get();
		}

		return $this->model->get();

	}

	public function create($request)
	{
		return $this->model->create([
			'name'		=>	$request['name'],
			'slug'		=>	$request['slug'],
			'status'	=>	$request['status']
		]);
	}

	public function update($id, $request)
	{
		return $this->model
			->where('id', $id)
			->update([
			'name'		=>	$request['name'],
			'slug'		=>	$request['slug'],
			'status'	=>	$request['status']
		]);
	}

	public function delete($id)
	{
		return $this->model
			->where('id', $id)
			->delete();
	}


}