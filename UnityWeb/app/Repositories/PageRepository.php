<?php namespace App\Repositories;

use App\Models\Page;

class PageRepository implements PageRepositoryInterface {

	protected $page;

	public function __construct(Page $page)
	{
		$this->page = $page;
	}

	public function all($paginate = 25)
	{
		return $this->page
			->orderBy('created_at', 'desc')
			->paginate($paginate);
	}

	public function allByStatus($active = 1)
	{
		return $this->page
			->where('status', $active)
			->orderBy('slug', 'asc')
			->get();
	}

	public function find($id)
	{
		return $this->page->find($id);
	}

	public function findBySlug($slug)
	{
		return $this->page
			->where('slug', $slug)
			->where('status', 1)
			->first();
	}

	public function create($request)
	{
		return $this->page
			->create([
				'title'		=>	$request['title'],
				'slug'		=>	$request['slug'],
				'status'	=>	$request['status'],
				'content'	=>	$request['content'],
			]);
	}

	public function update($id, $request)
	{
		return $this->page
			->where('id', $id)
			->update([
				'title'		=>	$request['title'],
				'slug'		=>	$request['slug'],
				'status'	=>	$request['status'],
				'content'	=>	$request['content'],
			]);
	}

	public function delete($id)
	{
		return $this->page
			->where('id', $id)
			->delete();
	}
}