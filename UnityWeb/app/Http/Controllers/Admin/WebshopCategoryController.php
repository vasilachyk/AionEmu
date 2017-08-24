<?php

namespace App\Http\Controllers\Admin;

use Settings;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Delete;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WebshopCategory;
use App\Http\Requests\Admin\WebshopCategoryEdit;
use App\Repositories\WebshopCategoryRepositoryInterface;

class WebshopCategoryController extends Controller {

	protected $webshopCategory;

	public function __construct(WebshopCategoryRepositoryInterface $webshopCategory)
	{
		$this->middleware('auth.access:'.Settings::access()->webshop_category);

		$this->webshopCategory = $webshopCategory;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = [
			'categories' => $this->webshopCategory->getAll()
		];

		return view('admin.webshop.category', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.webshop.category-create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(WebshopCategory $request)
	{
		$create = $this->webshopCategory->create($request->all());

		return $create ? redirect()->action('Admin\WebshopCategoryController@create')->with('success', 'Category '. $request->get('name') . ' has been added.') : redirect()->action('Admin\WebshopCategoryController@create')->with('failure', 'Category creation failed.');
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
			return redirect()->action('Admin\WebshopCategoryController@index')->with('failure', 'Unable to edit the selected category.');
		}

		$category = $this->webshopCategory->get($id);

		if (empty($category))
		{
			return redirect()->action('Admin\WebshopCategoryController@index')->with('failure', 'Category not found.');
		}

		$data = [
			'category' => $category
		];

		return view('admin.webshop.category-edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, WebshopCategoryEdit $request)
	{
		if ( ! is_numeric($id) || empty($id))
		{
			return redirect()->action('Admin\WebshopCategoryController@index')->with('failure', 'Unable to update the selected category.');
		}

		$update = $this->webshopCategory->update($id, $request->all());

		return $update ? redirect()->action('Admin\WebshopCategoryController@edit', $id)->with('success', 'Category ' . $request->get('name') . ' has been updated.') : redirect()->action('Admin\WebshopCategoryController@edit', $id)->with('failure', 'Category ' . $request->get('name') . ' update failed.');
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
			return redirect()->action('Admin\WebshopCategoryController@index')->with('failure', 'Unable to delete the selected category.');
		}

		$item = $this->webshopCategory->get($id);

		if ($request->ajax())
		{
			if ($item)
			{
				$this->webshopCategory->delete($item->id);

				return $id;
				// return redirect()->action('Admin\WebshopController@index')->with('success', 'Item #'. $id . ' has been deleted.');
			}
			else
			{
				// return redirect()->action('Admin\WebshopController@index')->with('failure', 'Item not found.');
				return response()->json(null, 404);
			}
		}

		return redirect()->action('Admin\WebshopCategoryController@index');
	}

}
