<?php

namespace App\Repositories;

use Auth;
use App\Models\Players;
use App\Models\PlayerRank;
use App\Models\PlayerBind;

class PlayerRepository implements PlayerRepositoryInterface {

	protected $players;

	protected $rank;

	protected $bind;

	public function __construct(Players $players, PlayerRank $rank, PlayerBind $bind)
	{
		$this->players = $players;

		$this->rank = $rank;

		$this->bind = $bind;
	}

	public function all($paginate = 25, $orderBy = 'desc')
	{
		return $this->players
			->leftJoin('player_punishments', 'players.id', '=', 'player_punishments.player_id')
			->select([
				'players.id',
				'players.name',
				'players.account_id',
				'players.account_name',
				'players.race',
				'players.player_class',
				'players.online',
				'player_punishments.player_id',
				'player_punishments.start_time',
				'player_punishments.punishment_type',
				'player_punishments.duration',
				'player_punishments.reason',
				'player_punishments.banned_by'
			])
			->orderBy('player_punishments.duration', $orderBy)
			->paginate($paginate);
	}

	public function getBan($orderBy = 'desc')
	{
		return $this->players
			->leftJoin('player_punishments', 'players.id', '=', 'player_punishments.player_id')
			->select([
				'players.id',
				'players.name',
				'players.account_id',
				'players.account_name',
				'players.race',
				'players.player_class',
				'players.online',
				'player_punishments.player_id',
				'player_punishments.start_time',
				'player_punishments.punishment_type',
				'player_punishments.duration',
				'player_punishments.reason',
				'player_punishments.banned_by'
			])
			->where('player_punishments.player_id', '<>', '')
			->where('players.account_id', Auth::user()->id)
			->orderBy('player_punishments.duration', $orderBy)
			->get();
	}

	public function find($id)
	{
		return $this->players
			->where('id', $id)
			->select([
				'id',
				'name',
				'account_id',
				'account_name',
				'race',
				'player_class',
				'online',
				'x',
				'y',
				'z',
				'heading',
				'world_id',
				'world_owner'
			])
			->first();
	}

	public function findWithAccountId($id, $accountId)
	{
		return $this->players
			->where('id', $id)
			->where('account_id', $accountId)
			->select([
				'id',
				'name',
				'account_id',
				'account_name',
				'race',
				'player_class',
				'online',
				'x',
				'y',
				'z',
				'heading',
				'world_id',
				'world_owner'
			])
			->first();
	}

	public function findByName($name)
	{
		return $this->players
			->where('name', $name)
			->select([
				'id',
				'name',
				'account_id',
				'account_name',
				'race',
				'player_class',
				'online',
				'x',
				'y',
				'z',
				'heading',
				'world_id',
				'world_owner'
			])->first();
	}

	public function getOnline()
	{
		return $this->players
			->select([
				'id',
				'name',
				'exp',
				'gender',
				'race',
				'player_class',
				'online',
				'x',
				'y',
				'z',
				'heading',
				'world_id',
				'world_owner'
			])
			->where('online', 1)
			->orderBy('name')
			->get();
	}

	public function getPlayerInfo($id)
	{
		return $this->rank
			->leftJoin('players', 'abyss_rank.player_id', '=', 'players.id')
			->leftJoin('legion_members', 'legion_members.player_id', '=', 'players.id')
			->leftJoin('legions', 'legions.id', '=', 'legion_members.legion_id')
			->where('players.id', $id)
			->select([
				'ap',
				'all_kill',
				'abyss_rank.rank',
				'players.id',
				'players.name',
				'exp',
				'world_id',
				'gender',
				'race',
				'player_class',
				'creation_date',
				'last_online',
				'title_id',
				'online',
				'account_id',
				'legions.id as legionid',
				'legions.name as legionname'
			])
			->first();
	}

	public function getPlayersByAccount($id)
	{
		return $this->players
			->select([
				'id',
				'name',
				'exp',
				'world_id',
				'gender',
				'race',
				'player_class',
				'online'
			])
			->where('account_id', $id)
			->orderBy('name')
			->get();
	}

	public function filterByName($name = null, $orderBy = 'desc', $paginate = 25)
	{
		return $this->players
			->leftJoin('player_punishments', 'players.id', '=', 'player_punishments.player_id')
			->select([
				'players.id',
				'players.name',
				'players.account_id',
				'players.account_name',
				'players.race',
				'players.player_class',
				'players.online',
				'player_punishments.player_id',
				'player_punishments.punishment_type',
				'player_punishments.duration',
				'player_punishments.reason'
			])
			->where('players.name', 'like', '%'.$name.'%')
			->orderBy('players.id', $orderBy)
			->paginate($paginate);
	}

	public function filterByPlayerID($id = null, $orderBy = 'desc', $paginate = 25)
	{
		return $this->players
			->leftJoin('player_punishments', 'players.id', '=', 'player_punishments.player_id')
			->select([
				'players.id',
				'players.name',
				'players.account_id',
				'players.account_name',
				'players.race',
				'players.player_class',
				'players.online',
				'player_punishments.player_id',
				'player_punishments.punishment_type',
				'player_punishments.duration',
				'player_punishments.reason'
			])
			->where('players..id', $id)
			->orderBy('players.id', $orderBy)
			->paginate($paginate);
	}

	public function filterByAccount($name = null, $orderBy = 'desc', $paginate = 25)
	{
		return $this->players
			->leftJoin('player_punishments', 'players.id', '=', 'player_punishments.player_id')
			->select([
				'players.id',
				'players.name',
				'players.account_id',
				'players.account_name',
				'players.race',
				'players.player_class',
				'players.online',
				'player_punishments.player_id',
				'player_punishments.punishment_type',
				'player_punishments.duration',
				'player_punishments.reason'
			])
			->where('players.account_name', 'like', '%'.$name.'%')
			->orderBy('players.id', $orderBy)
			->paginate($paginate);
	}

	public function filterByBan($ban = 'ALLBANNED', $orderBy = 'desc', $paginate = 25)
	{
		if ($ban == 'ALLBANNED')
		{
			return $this->players
				->leftJoin('player_punishments', 'players.id', '=', 'player_punishments.player_id')
				->select([
					'players.id',
					'players.name',
					'players.account_id',
					'players.account_name',
					'players.race',
					'players.player_class',
					'players.online',
					'player_punishments.player_id',
					'player_punishments.punishment_type',
					'player_punishments.duration',
					'player_punishments.reason'
				])
				->where('player_punishments.player_id', '<>', '')
				->orderBy('players.id', $orderBy)
				->paginate($paginate);
		}
		else
		{
			return $this->players
				->leftJoin('player_punishments', 'players.id', '=', 'player_punishments.player_id')
				->select([
					'players.id',
					'players.name',
					'players.account_id',
					'players.account_name',
					'players.race',
					'players.player_class',
					'players.online',
					'player_punishments.player_id',
					'player_punishments.punishment_type',
					'player_punishments.duration',
					'player_punishments.reason'
				])
				->where('player_punishments.punishment_type', '=', $ban)
				->orderBy('players.id', $orderBy)
				->paginate($paginate);
		}

	}

	public function getBindPoint($id)
	{
		return $this->bind
			->where('player_id', $id)
			->first();
	}

	public function updatePlayerBindPoint($id, $mapid, $x, $y, $z, $heading)
	{
		return $this->players
			->where('id', $id)
			->update([
				'x'				=>	$x,
				'y'				=>	$y,
				'z'				=>	$z,
				'heading'		=>	$heading,
				'world_id'		=>	$mapid
			]);
	}
}