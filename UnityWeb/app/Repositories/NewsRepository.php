<?php namespace App\Repositories;

use Auth;
use App\Models\News;

class NewsRepository implements NewsRepositoryInterface {

	protected $news;

	public function __construct(News $news)
	{
		$this->news = $news;
	}

	public function findWithSlug($id, $slug)
	{
		return $this->news
			->leftJoin('cms_news_category', 'cms_news_category.id', '=', 'cms_news.category_id')
			->leftJoin('account_data', 'account_data.id', '=', 'cms_news.created_by')
			->leftJoin('account_data as updatedby', 'updatedby.id', '=', 'cms_news.updated_by')
			->where('deleted_at', '=', NULL)
			->where('cms_news.id', $id)
			->where('cms_news.slug', $slug)
			->select([
				'cms_news.id',
				'cms_news.title',
				'cms_news.slug',
				'cms_news.content',
				'cms_news.updated_at',
				'cms_news_category.title as catTitle',
				'account_data.id as createdby_id',
				'account_data.name as createdby_name',
				'updatedby.id as updatedby_id',
				'updatedby.name as updatedby_name'
			])
			->first();
	}

	public function find($id)
	{
		return $this->news->find($id);
	}

	public function show($limit = 6)
	{
		return $this->news
			->leftJoin('cms_news_category', 'cms_news_category.id', '=', 'cms_news.category_id')
			->leftJoin('account_data', 'account_data.id', '=', 'cms_news.created_by')
			->leftJoin('account_data as updatedby', 'updatedby.id', '=', 'cms_news.updated_by')
			->where('deleted_at', '=', NULL)
			->orderBy('cms_news.updated_at', 'desc')
			->take($limit)
			->select([
				'cms_news.id',
				'cms_news.title',
				'cms_news.slug',
				'cms_news.content',
				'cms_news.created_at',
				'cms_news_category.title as catTitle',
				'account_data.id as createdby_id',
				'account_data.name as createdby_name',
				'updatedby.id as updatedby_id',
				'updatedby.name as updatedby_name'
			])
			->get();
	}

	public function all($paginate = 25, $deleted = '=')
	{
		return $this->news
			->leftJoin('cms_news_category', 'cms_news_category.id', '=', 'cms_news.category_id')
			->leftJoin('account_data', 'account_data.id', '=', 'cms_news.created_by')
			->leftJoin('account_data as updatedby', 'updatedby.id', '=', 'cms_news.updated_by')
			->where('deleted_at', $deleted, NULL)
			->orderBy('cms_news.updated_at', 'desc')
			->select([
				'cms_news.id',
				'cms_news.title',
				'cms_news.slug',
				'cms_news.content',
				'cms_news_category.title as catTitle',
				'account_data.id as createdby_id',
				'account_data.name as createdby_name',
				'updatedby.id as updatedby_id',
				'updatedby.name as updatedby_name'
			])
			->paginate($paginate);
	}

	public function create($request)
	{
		return $this->news
			->create([
				'title'			=>	$request['title'],
				'slug'			=>	$request['slug'],
				'category_id'	=>	$request['category'],
				'content'		=>	$request['content'],
				'created_by'	=>	Auth::user()->id
			]);
	}

	public function update($id, $request)
	{
		return $this->news
			->where('id', $id)
			->update([
				'title'			=>	$request['title'],
				'slug'			=>	$request['slug'],
				'category_id'	=>	$request['category'],
				'content'		=>	$request['content'],
				'updated_by'	=>	Auth::user()->id
			]);
	}

	public function delete($id)
	{
		$update = $this->news->where('id', $id)->update(['deleted_by' => Auth::user()->id]);

		return $this->news
			->where('id', $id)
			->delete();
	}
}