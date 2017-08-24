<?php

namespace App\Http\Controllers\Admin;

use Settings;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Webshop;
use App\Http\Requests\Admin\WebshopEdit;
use App\Http\Controllers\Controller;
use App\Repositories\WebshopRepositoryInterface;

class WebshopController extends Controller {

	protected $webshop;

	public function __construct(WebshopRepositoryInterface $webshop)
	{
		$this->middleware('auth.access:'.Settings::access()->webshop);

		$this->webshop = $webshop;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		if ($request->get('itemname'))
		{
			$items = $this->webshop->filterByItemNameAdmin($request->get('itemname'));
		}
		else
		{
			$items = $this->webshop->all();
		}

		$data = [
			'items'	=>	$items
		];

		return view('admin.webshop.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.webshop.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Webshop $request)
	{
		$create = $this->webshop->create($request->all());

		return $create ? redirect()->action('Admin\WebshopController@create')->with('success', 'Item '. $request->get('name') . ' has been added.') : redirect()->action('Admin\WebshopController@create')->with('failed', 'Failed to add an item.');
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
			return redirect()->action('Admin\WebshopController@index')->with('failure', 'Unable to edit the selected item.');
		}

		$item = $this->webshop->findAdmin($id);

		if (empty($item))
		{
			return redirect()->action('Admin\WebshopController@index')->with('failure', 'Item not found.');
		}

		$data = [
			'item'	=>	$item
		];

		return view('admin.webshop.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, WebshopEdit $request)
	{
		if ( ! is_numeric($id) || empty($id))
		{
			return redirect()->action('Admin\WebshopController@index')->with('failure', 'Unable to update the selected item.');
		}

		$update = $this->webshop->update($id, $request->all());

		return $update ? redirect()->action('Admin\WebshopController@edit', $id)->with('success', 'Item #'.$request->get('itemid').' '.$request->get('name').' has been updated.') : redirect()->action('Admin\WebshopController@edit', $id)->with('failure', 'Item #'.$id.' '.$request->get('name').' update failed.');
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
			return redirect()->action('Admin\WebshopController@index')->with('failure', 'Unable to delete the selected item.');
		}

		$item = $this->webshop->findAdmin($id);

		if ($request->ajax())
		{
			if ($item)
			{
				$this->webshop->delete($item->id);

				return $id;
				// return redirect()->action('Admin\WebshopController@index')->with('success', 'Item #'. $id . ' has been deleted.');
			}
			else
			{
				// return redirect()->action('Admin\WebshopController@index')->with('failure', 'Item not found.');
				return response()->json(null, 404);
			}
		}

		return redirect()->action('Admin\WebshopController@index');

	}

}
