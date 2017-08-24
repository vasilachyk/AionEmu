<?php

namespace App\Http\Controllers\Admin;

use Settings;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\SettingsGeneral;
use App\Http\Requests\Admin\SettingsPayment;
use App\Http\Requests\Admin\RoutesAccess;
use App\Http\Controllers\Controller;
use App\Repositories\SettingsRepositoryInterface;

class SettingsController extends Controller
{
    protected $settings;

    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->middleware('auth.access:'.Settings::access()->settings);

        $this->settings = $settings;
    }

    public function getIndex()
    {
        $data = [
            'settings'      =>  $this->settings->getGeneral(),
            'payment'       =>  $this->settings->getPayment(),
            'access'        =>  $this->settings->getRoutesAccess()
        ];

        return view('admin.settings.index', $data);
    }

    public function getEditGeneral()
    {
        $data = [
            'settings'  =>  $this->settings->getGeneral()
        ];

        return view('admin.settings.edit-general', $data);
    }

    public function postEditGeneral(SettingsGeneral $request)
    {
        $update = $this->settings->updateGeneral($request->all());

        return $update ? redirect()->action('Admin\SettingsController@getEditGeneral')->with('success', 'General Settings has been updated.') : redirect()->action('Admin\SettingsController@getEditGeneral')->with('failure', 'Unable to update the settings.');
    }

    public function getEditPayment()
    {
        $data = [
            'payment'  =>  $this->settings->getPayment()
        ];

        return view('admin.settings.edit-payment', $data);
    }

    public function postEditPayment(SettingsPayment $request)
    {
        $update = $this->settings->updatePayment($request->all());

        return $update ? redirect()->action('Admin\SettingsController@getEditPayment')->with('success', 'Payment Settings has been updated.') : redirect()->action('Admin\SettingsController@getEditPayment')->with('failure', 'Unable to update the settings.');
    }

    public function getEditRoutes()
    {
        $data = [
            'access'    =>  $this->settings->getRoutesAccess()
        ];

        return view('admin.settings.edit-routes-access', $data);
    }

    public function postEditRoutes(RoutesAccess $request)
    {
        $update = $this->settings->updateRoutes($request->all());

        return $update ? redirect()->action('Admin\SettingsController@getEditRoutes')->with('success', 'Routes access has been updated.') : redirect()->action('Admin\SettingsController@getEditRoutes')->with('failure', 'Unable to update the routes access.');
    }
}
