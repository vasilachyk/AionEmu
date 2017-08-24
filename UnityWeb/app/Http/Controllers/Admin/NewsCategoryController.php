<?php

namespace App\Http\Controllers\Admin;

use Settings;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Delete;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewsCategory;
use App\Http\Requests\Admin\NewsCategoryEdit;
use App\Repositories\NewsCategoryRepositoryInterface;

class NewsCategoryController extends Controller {

	protected $category;

	public function __construct(NewsCategoryRepositoryInterface $category)
	{
		$this->middleware('auth.access:'.Settings::access()->news_category);

		$this->category = $category;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = [
			'categories'	=>	$this->category->all()
		];

		return view('admin.news.category', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.news.category-create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(NewsCategory $request)
	{
		$create = $this->category->create($request->all());

		return $create ? redirect()->action('Admin\NewsCategoryController@create')->with('success', 'Category '.$request->get('title').' has been added.') : redirect()->action('Admin\NewsCategoryController@create')->with('failure', 'Unable to add a category.');
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
			return redirect()->action('Admin\NewsCategoryController@index')->with('failure', 'Unable to edit the selected category.');
		}

		$category = $this->category->find($id);

		if ( ! $category) return redirect()->action('Admin\NewsCategoryController@index')->with('failure', 'Category not found.');

		$data = [
			'category'	=> $category
		];

		return view('admin.news.category-edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, NewsCategoryEdit $request)
	{
		if ( ! is_numeric($id) || empty($id))
		{
			return redirect()->action('Admin\NewsCategoryController@index')->with('failure', 'Unable to update the selected category.');
		}

		$update = $this->category->update($id, $request->all());

		return $update ? redirect()->action('Admin\NewsCategoryController@edit', $id)->with('success', 'Category '.$request->get('title').' has been updated.') : redirect()->action('Admin\NewsCategoryController@edit', $id)->with('failure', 'Category '.$request->get('title').' update failed.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id, Delete $request)
	{
		if ( ! is_numeric($id) || empty($id))
		{
			return redirect()->action('Admin\NewsCategoryController@index')->with('failure', 'Unable to delete the selected category.');
		}

		$item = $this->category->find($id);

		if ($request->ajax())
		{
			if ($item)
			{
				$this->category->delete($item->id);

				return $id;
				// return redirect()->action('Admin\WebshopController@index')->with('success', 'Item #'. $id . ' has been deleted.');
			}
			else
			{
				// return redirect()->action('Admin\WebshopController@index')->with('failure', 'Item not found.');
				return response()->json(null, 404);
			}
		}

		return redirect()->action('Admin\NewsCategoryController@index');
	}

}
