<?php

namespace App\Http\Controllers\Admin;

use Settings;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\News;
use App\Http\Controllers\Controller;
use App\Repositories\NewsRepositoryInterface;

class NewsController extends Controller {

	protected $news;

	public function __construct(NewsRepositoryInterface $news)
	{
		$this->middleware('auth.access:'.Settings::access()->news);

		$this->news = $news;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = [
			'news'	=>	$this->news->all()
		];

		return view('admin.news.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.news.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(News $request)
	{
		$create = $this->news->create($request->all());

		return $create ? redirect()->action('Admin\NewsController@create')->with('success', 'News has been created.') : redirect()->action('Admin\NewsController@create')->with('failure', 'Unable to create news.');
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
			return redirect()->action('Admin\NewsController@index')->with('failure', 'Unable to edit the selected news.');
		}

		$news = $this->news->find($id);

		if ( ! $news) return redirect()->action('Admin\NewsController@index')->with('failure', 'News not found.');

		$data = [
			'news'	=>	$news
		];

		return view('admin.news.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, News $request)
	{
		if ( ! is_numeric($id) || empty($id))
		{
			return redirect()->action('Admin\NewsController@index')->with('failure', 'Unable to update the selected news.');
		}

		$update = $this->news->update($id, $request->all());

		return $update ? redirect()->action('Admin\NewsController@edit', $id)->with('success', 'News has been updated.') : redirect()->action('Admin\NewsController@index')->with('failure', 'Unable to update the news.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id, Request $request)
	{
		if ( ! is_numeric($id) || empty($id))
		{
			return redirect()->action('Admin\NewsController@index')->with('failure', 'Unable to delete the selected news.');
		}

		$news = $this->news->find($id);

		if ($request->ajax())
		{
			if ($news)
			{
				$this->news->delete($news->id);

				return $id;
			}
			else
			{
				return response()->json(null, 404);
			}
		}

		return redirect()->action('Admin\NewsController@index');
	}

}
