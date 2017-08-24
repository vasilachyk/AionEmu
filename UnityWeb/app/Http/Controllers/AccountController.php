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

class AccountController extends Controller {

	protected $account;

	protected $players;

	protected $membership;

	protected $log;

	public function __construct(AccountRepositoryInterface $account, PlayerRepositoryInterface $players, MembershipRepositoryInterface $membership, LogRepositoryInterface $log)
	{
		$this->account = $account;

		$this->players = $players;

		$this->membership = $membership;

		$this->log = $log;
	}

	public function getIndex()
	{
		$data = [
			'memberships'	=>	$this->membership->get(),
			'characters'	=>	$this->account->listCharacters()
		];

		return view('pages.account.index', $data);
	}

	public function getPassword()
	{
		return view('pages.account.password');
	}

	public function postPassword(Password $request)
	{
		if ( ! Hash::check($request->get('old_password'), $request->user()->password))
		{
			return redirect()->action('AccountController@getPassword')->with('failure', 'Invalid old password.');
		}

		$result = $this->account->changePassword($request->all());

		return $result ? redirect()->action('AccountController@getPassword')->with('success', 'Password has been changed.') : redirect()->action('AccountController@getPassword')->with('failure', 'Password change failed.');
	}

	public function getBan()
	{
		$data = [
			'bans'	=>	$this->players->getBan()
		];

		return view('pages.account.ban', $data);
	}

	public function getWebshopPurchase()
	{
		$data = [
			'weblogs'	=>	$this->log->getWebshopPurchaseByAccount(Auth::user()->id)
		];

		return view('pages.account.webshop', $data);
	}

	public function getUnstuck()
	{
		$data = [
			'players'	=>	$this->players->getPlayersByAccount(Auth::user()->id)
		];

		return view('pages.account.unstuck', $data);
	}

	public function postUnstuck(Unstuck $request)
	{
		$player = $this->players->findWithAccountId($request->get('player'), Auth::user()->id);

		if (empty($player))
		{
			return redirect()->action('AccountController@getUnstuck')->with('failure', 'Player not found.');
		}

		if ($player->online)
		{
			return redirect()->action('AccountController@getUnstuck')->with('failure', 'Please logout before using the unstuck.');
		}

		$unstuckLog = $this->log->findUnstuckLog(Auth::user()->id);

		if (empty($unstuckLog))
		{
			$bindPoint = $this->players->getBindPoint($player->id);

			if (empty($bindPoint))
			{
				if ($player->race == 'ASMODIANS' || $player->race == 'ASMODIAN')
				{
					$unstuck = $this->players->updatePlayerBindPoint($player->id, 120010000, 1268, 1428, 208, 0);
				}
				else
				{
					$unstuck = $this->players->updatePlayerBindPoint($player->id, 110010000, 1532, 1511, 565, 0);
				}

				if ($unstuck)
				{
					$this->log->createUnstuckLog(Auth::user()->id);
				}

				return $unstuck ? redirect()->action('AccountController@getUnstuck')->with('success', $player->name . ' is now unstuck.') : redirect()->action('AccountController@getUnstuck')->with('failure', 'Unable to unstuck ' . $player->name);
			}
			else
			{
				$unstuck = $this->players->updatePlayerBindPoint($bindPoint->player_id, $bindPoint->map_id, $bindPoint->x, $bindPoint->y, $bindPoint->z, $bindPoint->heading);

				if ($unstuck)
				{
					$this->log->createUnstuckLog(Auth::user()->id);
				}

				return $unstuck ? redirect()->action('AccountController@getUnstuck')->with('success', $player->name . ' is now unstuck.') : redirect()->action('AccountController@getUnstuck')->with('failure', 'Unable to unstuck ' . $player->name);
			}
		}
		else
		{
			if ($unstuckLog->expire > Carbon::now())
			{
				return redirect()->action('AccountController@getUnstuck')->with('failure', 'Unable to unstuck, You can unstuck again in ' . $unstuckLog->expire);
			}
			else
			{
				$bindPoint = $this->players->getBindPoint($player->id);

				if (empty($bindPoint))
				{
					if ($player->race == 'ASMODIANS' || $player->race == 'ASMODIAN')
					{
						$unstuck = $this->players->updatePlayerBindPoint($player->id, 120010000, 1268, 1428, 208, 0);
					}
					else
					{
						$unstuck = $this->players->updatePlayerBindPoint($player->id, 110010000, 1532, 1511, 565, 0);
					}

					if ($unstuck)
					{
						$this->log->updateUnstuckLog(Auth::user()->id);
					}

					return $unstuck ? redirect()->action('AccountController@getUnstuck')->with('success', $player->name . ' is now unstuck.') : redirect()->action('AccountController@getUnstuck')->with('failure', 'Unable to unstuck ' . $player->name);
				}
				else
				{
					$unstuck = $this->players->updatePlayerBindPoint($bindPoint->player_id, $bindPoint->map_id, $bindPoint->x, $bindPoint->y, $bindPoint->z, $bindPoint->heading);

					if ($unstuck)
					{
						$this->log->updateUnstuckLog(Auth::user()->id);
					}

					return $unstuck ? redirect()->action('AccountController@getUnstuck')->with('success', $player->name . ' is now unstuck.') : redirect()->action('AccountController@getUnstuck')->with('failure', 'Unable to unstuck ' . $player->name);
				}
			}
		}

	}

	public function postActivateMembership(Membership $request)
	{
		$membershipId = $request->get('membership')['id'];

		$membership = $this->membership->find($membershipId);

		if (empty($membership))
		{
			return redirect()->action('AccountController@getIndex')->with('failure', 'The selected membership does not exists.');
		}

		if (Settings::general()->donate_type == 'CREDITS')
		{
			if (Auth::user()->donate_points < $membership->price)
			{
				return redirect()->action('AccountController@getIndex')->with('failure', 'Insufficient Credit Points for membership activation.');
			}
		}
		else
		{
			if (Auth::user()->toll < $membership->price)
			{
				return redirect()->action('AccountController@getIndex')->with('failure', 'Insufficient Toll Points for membership activation.');
			}
		}

		if ($membership->type == 2)
		{
			$response = $this->account->buyVip($membership);

			return $response ? redirect()->action('AccountController@getIndex')->with('success', 'Thank you, your account is now a vip member.') : redirect()->action('AccountController@getIndex')->with('failure', 'Unable to purchase membership, please try again later.');
		}
		else
		{
			$response = $this->account->buyPremium($membership);

			return $response ? redirect()->action('AccountController@getIndex')->with('success', 'Thank you, your account is now a premium member.') : redirect()->action('AccountController@getIndex')->with('failure', 'Unable to purchase membership, please try again later.');
		}
	}
}
