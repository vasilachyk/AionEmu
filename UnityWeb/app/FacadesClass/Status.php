<?php

namespace App\FacadesClass;

use Settings;
use Cache;
use Carbon;
use App\Repositories\StatusRepositoryInterface;
use App\Repositories\LogRepositoryInterface;

class Status
{
	protected $status;
	protected $log;

	public function __construct(StatusRepositoryInterface $status, LogRepositoryInterface $log)
	{
		$this->status = $status;

		$this->log = $log;
	}

	public function gameServer($ip, $port)
	{
		if (is_null(Cache::get('gameServer')))
		{
			Cache::put('gameServer', $this->status->server($ip, $port), 1);
		}

		return Cache::get('gameServer');
	}

	public function loginServer($ip, $port)
	{
		if (is_null(Cache::get('loginServer')))
		{
			Cache::put('loginServer', $this->status->server($ip, $port), 1);
		}

		return Cache::get('loginServer');
	}

	public function onlineCount()
	{
		return $this->status->getOnlineCount();
	}

	public function onlineAsmo()
	{
		return $this->status->getOnlineAsmo();
	}

	public function onlineEly()
	{
		return $this->status->getOnlineEly();
	}

	public function totalAccounts()
	{
		return $this->status->getTotalAccounts();
	}

	public function totalPlayers()
	{
		return $this->status->getTotalPlayers();
	}

	public function totalLegions()
	{
		return $this->status->getTotalLegions();
	}

	public function totalLegionsPerRace($race)
	{
		return $this->status->getTotalLegionsPerRace($race);
	}

	public function totalGmsOnline()
	{
		return $this->status->totalGmsOnline();
	}

	public function totalGms()
	{
		return $this->status->getTotalGms();
	}

	public function totalAsmo()
	{
		return $this->status->getTotalAsmodians();
	}

	public function totalEly()
	{
		return $this->status->getTotalElyos();
	}

	public function totalPlayerCountPerClass($class)
	{
		return $this->status->getPlayerCountPerClass($class);
	}

	public function playerClass()
	{
		return [
			'WARRIOR',
			'GLADIATOR',
			'TEMPLAR',
			'SCOUT',
			'ASSASSIN',
			'RANGER',
			'MAGE',
			'SORCERER',
			'SPIRIT_MASTER',
			'PRIEST',
			'CLERIC',
			'CHANTER',
			'ENGINEER',
			'GUNNER',
			'RIDER',
			'ARTIST',
			'BARD'
		];
	}

	public function numberOfPlayersPerLevelBracket($lvl)
	{
		return $this->status->getTotalPlayersPerLevelBracket($lvl);
	}

	public function onlinePeakCount()
	{
		return $this->log->onlinePeakCount();
	}

	public function onlinePeakCount24Hrs()
	{
		return $this->log->onlinePeakCount24Hrs();
	}
}