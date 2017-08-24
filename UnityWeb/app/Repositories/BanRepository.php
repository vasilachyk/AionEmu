<?php

namespace App\Repositories;

use Auth;
use Carbon;
use Request;
use App\Models\BanChar;
use App\Models\BanIp;
use App\Models\BanMac;

class BanRepository implements BanRepositoryInterface {

	protected $banChar;

	protected $banMac;

	protected $banIp;

	public function __construct(BanChar $banChar, BanMac $banMac, BanIp $banIp)
	{
		$this->banChar = $banChar;

		$this->banMac = $banMac;

		$this->banIp = $banIp;
	}

	public function findChar($playerid)
	{
		return $this->banChar->where('player_id', $playerid)->first();
	}

	public function createChar($playerid, $request)
	{
		if ($request['duration'] == 0)
		{
			$days = Carbon::createFromTimestamp(0)->diffInSeconds(Carbon::createFromTimestamp(0)->addYears(68)->addWeeks(2)->addDays(4)->addHours(3)->addSeconds(847));
		}
		else
		{
			$days = Carbon::now()->diffInSeconds(Carbon::now()->addDays($request['duration']));
		}

		return $this->banChar->create([
			'player_id'			=>	$playerid,
			'punishment_type'	=>	$request['type'],
			'start_time'		=>	Carbon::now()->timestamp,
			'duration'			=>	$days,
			'reason'			=>	$request['reason'],
			'banned_by'			=>	Auth::user()->name
		]);
	}

	public function updateChar($playerid, $request)
	{
		if ($request['duration'] == 0)
		{
			$days = Carbon::createFromTimestamp(0)->diffInSeconds(Carbon::createFromTimestamp(0)->addYears(68)->addWeeks(2)->addDays(4)->addHours(3)->addSeconds(847));
		}
		else
		{
			$days = Carbon::now()->diffInSeconds(Carbon::now()->addDays($request['duration']));
		}

		return $this->banChar
			->where('player_id', $playerid)
			->update([
			'punishment_type'	=>	$request['type'],
			'start_time'		=>	Carbon::now()->timestamp,
			'duration'			=>	$days,
			'reason'			=>	$request['reason'],
			'banned_by'			=>	Auth::user()->name
			]);
	}

	public function removeChar($playerid)
	{
		return $this->banChar->where('player_id', '=', $playerid)->delete();
	}

	public function getBannedIps($paginate = 25)
	{
		return $this->banIp
			->orderBy('id', 'desc')
			->paginate($paginate);
	}

	public function findIpById($id)
	{
		return $this->banIp->where('id', $id)->first();
	}

	public function updateIpBan($id, $request)
	{
		$time = $request['duration'] == 0 ? null : Carbon::now()->addDays($request['duration']);

		return $this->banIp
			->where('id', $id)
			->update([
				'time_end'	=>	$time
			]);
	}

	public function removeIpBan($id)
	{
		return $this->banIp->where('id', '=', $id)->delete();
	}

	public function filterBannedIp($ip, $paginate = 25)
	{
		return $this->banIp
			->where('mask', 'like', '%'.$ip.'%')
			->orderBy('id', 'desc')
			->paginate($paginate);
	}

	public function getBannedMacs($paginate = 25)
	{
		return $this->banMac
			->orderBy('uniId', 'desc')
			->paginate($paginate);
	}

	public function filterBannedMac($mac, $paginate = 25)
	{
		return $this->banMac
			->where('address', 'like', '%'.$mac.'%')
			->orderBy('uniId', 'desc')
			->paginate($paginate);
	}

	public function findMacById($id)
	{
		return $this->banMac->where('uniId', $id)->first();
	}

	public function removeMacBan($id)
	{
		return $this->banMac->where('uniId', '=', $id)->delete();
	}

	public function accountViewIpBan()
	{
		return $this->banIp->where('mask', Request::ip())->first();
	}
}