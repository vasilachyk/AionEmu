<?php

namespace App\Repositories;

use App\Models\NewsCategory;

class NewsCategoryRepository implements NewsCategoryRepositoryInterface {

	protected $model;

	public function __construct(NewsCategory $model)
	{
		$this->model = $model;
	}

	public function all($paginate = 25)
	{
		return $this->model
			->orderBy('created_at', 'desc')
			->paginate($paginate);
	}

	public function get($status = 1)
	{
		return $this->model
			->where('status', $status)
			->get();
	}

	public function find($id)
	{
		return $this->model->find($id);
	}

	public function create($request)
	{
		return $this->model->create([
			'title'		=>	$request['title'],
			'slug'		=>	$request['slug'],
			'status'	=>	$request['status']
		]);
	}

	public function update($id, $request)
	{
		return $this->model
			->where('id', $id)
			->update([
				'title'		=>	$request['title'],
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