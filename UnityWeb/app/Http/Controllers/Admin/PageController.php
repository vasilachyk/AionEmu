<?php

namespace App\Http\Controllers\Admin;

use Settings;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Page;
use App\Http\Requests\Admin\PageEdit;
use App\Http\Controllers\Controller;
use App\Repositories\PageRepositoryInterface;

class PageController extends Controller {

	protected $page;

	public function __construct(PageRepositoryInterface $page)
	{
		$this->middleware('auth.access:'.Settings::access()->pages);

		$this->page = $page;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = [
			'pages'	=>	$this->page->all()
		];

		return view('admin.page.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.page.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Page $request)
	{
		$page = $this->page->create($request->all());

		return $page ? redirect()->action('Admin\PageController@create')->with('success', 'Page has been created successfully.') : redirect()->action('Admin\PageController@create')->with('failure', 'Unable to create the page.');
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
			return redirect()->action('Admin\PageController@index')->with('failure', 'Unable to edit the selected page.');
		}

		$page = $this->page->find($id);

		if (empty($page))
		{
			return redirect()->action('Admin\PageController@index')->with('failure', 'Page not found.');
		}

		$data =	[
			'page'	=>	$page
		];

		return view('admin.page.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, PageEdit $request)
	{
		if ( ! is_numeric($id) || empty($id))
		{
			return redirect()->action('Admin\PageController@index')->with('failure', 'Unable to edit the selected page.');
		}

		$update = $this->page->update($id, $request->all());

		return $update ? redirect()->action('Admin\PageController@edit', $id)->with('success', 'Page has been updated.') : redirect()->action('Admin\PageController@index')->with('failure', 'Unable to update the selected page.');
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
			return redirect()->action('Admin\PageController@index')->with('failure', 'Unable to delete the selected page.');
		}

		$page = $this->page->find($id);

		if ($request->ajax())
		{
			if ($page)
			{
				$this->page->delete($page->id);

				return $id;
			}
			else
			{
				return response()->json(null, 404);
			}
		}

		return redirect()->action('Admin\PageController@index');
	}

}
