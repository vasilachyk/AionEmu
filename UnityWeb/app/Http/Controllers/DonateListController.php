<?php

namespace App\Http\Controllers;

use Hash;
use Auth;
use Settings;
use Carbon;
use App\Http\Requests\Password;
use App\Http\Requests\Membership;
use App\Http\Requests\Unstuck;
use App\Repositories\AccountRepositoryInterface;
use App\Repositories\PlayerRepositoryInterface;
use App\Repositories\MembershipRepositoryInterface;
use App\Repositories\LogRepositoryInterface;

class DonateListController extends Controller {
    public  function index() {
        return view('pages.donate_list.donate');
    }
}