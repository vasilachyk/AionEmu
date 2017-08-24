<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Players;
use App\Models\Legions;
use App\Models\LegionMembers;

class StatusRepository implements StatusRepositoryInterface {

	protected $user;

	protected $players;

	protected $legions;

	protected $legionMembers;

	public function __construct(User $user, Players $players, Legions $legions, LegionMembers $legionMembers)
	{
		$this->user = $user;

		$this->players = $players;

		$this->legions = $legions;

		$this->legionMembers = $legionMembers;
	}

	public function server($ip, $port)
	{
		$fp = @fsockopen($ip, $port, $errno, $errstr, 1);
		#biar ganeteng
		
		echo $fp ? "<font color='green'>Online</font>" : "<font color='red'>Offline</font>"; 
	}

	public function getOnlineCount()
	{
		return $this->players->where('online', 1)->count();
	}

	public function getOnlineAsmo()
	{
		return $this->players
			->where('race', 'ASMODIANS')
			->where('online', 1)
			->count();
	}

	public function getOnlineEly()
	{
		return $this->players
			->where('race', 'ELYOS')
			->where('online', 1)
			->count();
	}

	public function getTotalAccounts()
	{
		return $this->user->select(['id'])->count();
	}

	public function getTotalPlayers()
	{
		return $this->players->select(['id'])->count();
	}

	public function getTotalLegions()
	{
		return $this->legions->select(['id'])->count();
	}

	public function getTotalLegionsPerRace($race)
	{
		return $this->legionMembers
			->leftJoin('players', 'players.id', '=', 'legion_members.player_id')
			->where('legion_members.rank', 'BRIGADE_GENERAL')
			->where('players.race', $race)
			->select([
				'players.race',
				'players.id'
			])
			->count();
	}

	public function getTotalGms()
	{
		return $this->user
			->where('access_level', '>=', 1)
			->select(['id'])
			->count();
	}

	public function totalGmsOnline()
	{
		$ids = [];

		$accounts = $this->user
			->where('access_level', '>=', 1)
			->select(['id'])
			->get();

		foreach ($accounts as $account)
		{
			$ids[] = $account->id;
		}

		return $this->players
			->whereIn('account_id', $ids)
			->where('online', 1)
			->count();
	}

	public function getTotalAsmodians()
	{
		return $this->players
			->where('race', 'ASMODIANS')
			->orWhere('race', 'ASMODIAN')
			->select(['id'])
			->count();
	}

	public function getTotalElyos()
	{
		return $this->players
			->where('race', 'ELYOS')
			->select(['id'])
			->count();
	}

	public function getPlayerCountPerClass($class)
	{
		return $this->players
			->where('player_class', $class)
			->select(['id'])
			->count();
	}

	public function getTotalPlayersPerLevelBracket($level)
	{
		if ($level == 10) $exp = 'exp <= 307558';
		elseif ($level == 20) $exp = 'exp > 307558 AND exp <= 4820229';
		elseif ($level == 30) $exp = 'exp > 4820229 AND exp <= 35939440';
		elseif ($level == 35) $exp = 'exp > 35939440 AND exp <= 89321807';
		elseif ($level == 40) $exp = 'exp > 89321807 AND exp <= 243343723';
		elseif ($level == 45) $exp = 'exp > 243343723 AND exp <= 559280864';
		elseif ($level == 50) $exp = 'exp > 559280864 AND exp <= 1128723910';
		elseif ($level == 55) $exp = 'exp > 1128723910';
		else $exp = 0;

		return $this->players
			->where('exp', '>', 307558)
			->where('exp', '<=', 99999999999)
			->count();
	}
}