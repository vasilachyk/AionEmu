<?php

namespace App\Http\Controllers\Admin;

use Settings;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Membership;
use App\Http\Controllers\Controller;
use App\Repositories\MembershipRepositoryInterface;

class MembershipController extends Controller
{
    protected $membership;

    public function __construct(MembershipRepositoryInterface $membership)
    {
        $this->middleware('auth.access:'.Settings::access()->membership);

        $this->membership = $membership;
    }

    public function getIndex()
    {
        $data = [
            'categories'    =>  $this->membership->getCategories()
        ];

        return view('admin.membership.index', $data);
    }

    public function postCreate(Membership $request)
    {
        $membership = $this->membership->create($request->all());

        return $membership ? redirect()->action('Admin\MembershipController@getIndex')->with('success', 'Privilege has been created successfully.') : redirect()->action('Admin\MembershipController@getIndex')->with('failure', 'Unable to create the privilege.');
    }

    public function getEdit($id = null)
    {
        if ( ! is_numeric($id))
        {
            return redirect()->action('Admin\MembershipController@getIndex')->with('failure', 'Unable to edit the selected privilege.');
        }

        $membership = $this->membership->find($id);

        if (empty($membership))
        {
            return redirect()->action('Admin\MembershipController@getIndex')->with('failure', 'Unable to find the selected privilege.');
        }

        $data = [
            'membership'    =>  $membership,
            'categories'    =>  $this->membership->getCategories()
        ];

        return view('admin.membership.edit', $data);
    }

    public function postEdit($id = null, Membership $request)
    {
        if ( ! is_numeric($id))
        {
            return redirect()->action('Admin\MembershipController@getIndex')->with('failure', 'Unable to update the selected privilege.');
        }

        $membership = $this->membership->find($id);

        if (empty($membership))
        {
            return redirect()->action('Admin\MembershipController@getIndex')->with('failure', 'Unable to find the selected privilege.');
        }

        $update = $this->membership->update($membership->id, $request->all());

        return $update ? redirect()->action('Admin\MembershipController@getEdit', $membership->id)->with('success', 'Privilege '.$membership->title.' has been updated successfully.') : redirect()->action('Admin\MembershipController@getEdit', $membership->id)->with('failure', 'Unable to update the privilege.');
    }

    public function postDelete($id)
    {
        if ( ! is_numeric($id))
        {
            return redirect()->action('Admin\MembershipController@getIndex')->with('failure', 'Unable to update the selected privilege.');
        }

        $membership = $this->membership->find($id);

        if (empty($membership))
        {
            return redirect()->action('Admin\MembershipController@getIndex')->with('failure', 'Unable to find the selected privilege.');
        }

        $delete = $this->membership->delete($membership->id);

        return $delete ? redirect()->action('Admin\MembershipController@getIndex', $membership->id)->with('success', 'Privilege '.$membership->title.' has been deleted successfully.') : redirect()->action('Admin\MembershipController@getIndex')->with('failure', 'Unable to delete the privilege.');
    }
}
