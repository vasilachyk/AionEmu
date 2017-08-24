<?php

namespace App\Http\Controllers\Admin;

use Settings;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\VoteSiteAdd;
use App\Http\Requests\Admin\VoteSiteEdit;
use App\Http\Controllers\Controller;
use App\Repositories\VoteRepositoryInterface;

class VoteController extends Controller {

	protected $vote;

	public function __construct(VoteRepositoryInterface $vote)
	{
		$this->middleware('auth.access:'.Settings::access()->vote);

		$this->vote = $vote;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = [
			'sites'	=>	$this->vote->getAll()
		];

		return view('admin.vote.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.vote.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(VoteSiteAdd $request)
	{
		$create = $this->vote->create($request->all());

		return $create ? redirect()->action('Admin\VoteController@create')->with('success', 'The site '. $request->get('name') . ' has been added.') : redirect()->action('Admin\VoteController@create')->with('failure', 'Unable to add the site.');
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
			return redirect()->action('Admin\VoteController@index')->with('failure', 'Unable to edit the selected site.');
		}

		$site = $this->vote->find($id);

		if ( ! $site) return redirect()->action('Admin\VoteController@index')->with('failure', 'Site not found.');

		$data = [
			'site'	=>	$site
		];

		return view('admin.vote.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, VoteSiteEdit $request)
	{
		if ( ! is_numeric($id) || empty($id))
		{
			return redirect()->action('Admin\VoteController@index')->with('failure', 'Unable to update the selected site.');
		}

		$update = $this->vote->update($id, $request->all());

		return $update ? redirect()->action('Admin\VoteController@edit', $id)->with('success', 'Vote site has been updated.') : redirect()->action('Admin\VoteController@edit', $id)->with('failure', 'Unable to update the selected vote site.');
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
			return redirect()->action('Admin\VoteController@index')->with('failure', 'Unable to delete the selected site.');
		}

		$site = $this->vote->find($id);

		if ($request->ajax())
		{
			if ($site)
			{
				$this->vote->delete($site->id);

				return $id;
			}
			else
			{
				return response()->json(null, 404);
			}
		}

		return redirect()->action('Admin\VoteController@index');
	}

}
