<?php namespace App\Repositories;

use App\Models\Players;
use App\Models\PlayerRank;
use App\Models\Legions;
use App\Models\Inventory;

class RankingRepository implements RankingRepositoryInterface {

	protected $rank;

	protected $players;

	protected $legions;

	protected $inventory;

	public function __construct(PlayerRank $rank, Players $players, Legions $legions, Inventory $inventory)
	{
		$this->rank = $rank;

		$this->players = $players;

		$this->legions = $legions;

		$this->inventory = $inventory;
	}

	public function getPlayers($limit = 10)
	{
		return $this->rank
			->leftJoin('players', 'abyss_rank.player_id', '=', 'players.id')
			->where('ap', '>', 1)
			->orderBy('ap', 'desc')
			->take($limit)
			->select([
				'ap',
				'id',
				'name',
				'exp',
				'race',
				'gender',
				'player_class',
				'online'
			])
			->get();
	}

	public function getAbyss($limit = 100)
	{
		return $this->rank
			->leftJoin('players', 'abyss_rank.player_id', '=', 'players.id')
			->where('ap', '>', 1)
			->orderBy('ap', 'desc')
			->take($limit)
			->select([
				'ap',
				'all_kill',
				'rank',
				'id',
				'name',
				'exp',
				'race',
				'gender',
				'player_class'
			])
			->get();
	}

	public function getAbyssFilterBy($limit = 100, $filter)
	{
		$race = $filter == 'asmo' ? 'ASMODIANS' : 'ELYOS';

		return $this->rank
			->leftJoin('players', 'abyss_rank.player_id', '=', 'players.id')
			->where('ap', '>', 1)
			->where('race', $race)
			->orderBy('ap', 'desc')
			->take($limit)
			->select([
				'ap',
				'all_kill',
				'rank',
				'id',
				'name',
				'exp',
				'race',
				'gender',
				'player_class'
			])
			->get();
	}

	public function getGP($limit = 100)
	{
		return $this->rank
			->leftJoin('players', 'abyss_rank.player_id', '=', 'players.id')
			->where('gp', '>', 1)
			->orderBy('gp', 'desc')
			->take($limit)
			->select([
				'ap',
				'gp',
				'all_kill',
				'rank',
				'id',
				'name',
				'exp',
				'race',
				'gender',
				'player_class'
			])
			->get();
	}

	public function getGPFilterBy($limit = 100, $filter)
	{
		$race = $filter == 'asmo' ? 'ASMODIANS' : 'ELYOS';

		return $this->rank
			->leftJoin('players', 'abyss_rank.player_id', '=', 'players.id')
			->where('gp', '>', 1)
			->where('race', $race)
			->orderBy('gp', 'desc')
			->take($limit)
			->select([
				'ap',
				'gp',
				'all_kill',
				'rank',
				'id',
				'name',
				'exp',
				'race',
				'gender',
				'player_class'
			])
			->get();
	}

	public function getAP($limit = 100)
	{
		return $this->rank
			->leftJoin('players', 'abyss_rank.player_id', '=', 'players.id')
			->where('ap', '>', 1)
			->orderBy('ap', 'desc')
			->take($limit)
			->select([
				'ap',
				'gp',
				'all_kill',
				'rank',
				'id',
				'name',
				'exp',
				'race',
				'gender',
				'player_class'
			])
			->get();
	}

	public function getAPFilterBy($limit = 100, $filter)
	{
		$race = $filter == 'asmo' ? 'ASMODIANS' : 'ELYOS';

		return $this->rank
			->leftJoin('players', 'abyss_rank.player_id', '=', 'players.id')
			->where('gp', '>', 1)
			->where('race', $race)
			->orderBy('ap', 'desc')
			->take($limit)
			->select([
				'ap',
				'gp',
				'all_kill',
				'rank',
				'id',
				'name',
				'exp',
				'race',
				'gender',
				'player_class'
			])
			->get();
	}

	public function getPlayersByExp($limit = 100, $class = null)
	{
		if (empty($class))
		{
			return $this->players
				->where('exp', '>', 1)
				->orderBy('exp', 'desc')
				->take($limit)
				->select([
					'id',
					'name',
					'exp',
					'race',
					'gender',
					'player_class',
					'online'
				])
				->get();
		}
		else
		{
			return $this->players
				->where('exp', '>', 1)
				->where('player_class', '=', $class)
				->orderBy('exp', 'desc')
				->take($limit)
				->select([
					'id',
					'name',
					'exp',
					'race',
					'gender',
					'player_class',
					'online'
				])
				->get();
		}

	}

	public function getLegions($limit = 100)
	{
		return $this->legions
			->leftJoin('legion_members', 'legions.id', '=', 'legion_members.legion_id')
			->leftJoin('players', 'legion_members.player_id', '=', 'players.id')
			->where('legion_members.rank', 'BRIGADE_GENERAL')
			->orderBy('contribution_points', 'desc')
            ->take($limit)
			->select([
				'players.name as players_name',
				'legions.id',
				'legions.name',
				'legions.level',
				'players.race',
				'contribution_points'
			])
			->get();
	}

	public function getLegionsFilterBy($limit = 100, $filter)
	{
		$race = $filter == 'asmo' ? 'ASMODIANS' : 'ELYOS';

		return $this->legions
			->leftJoin('legion_members', 'legions.id', '=', 'legion_members.legion_id')
			->leftJoin('players', 'legion_members.player_id', '=', 'players.id')
			->where('legion_members.rank', 'BRIGADE_GENERAL')
			->where('players.race', $race)
			->orderBy('contribution_points', 'desc')
            ->take($limit)
			->select([
				'players.name as players_name',
				'legions.id',
				'legions.name',
				'legions.level',
				'players.race',
				'contribution_points'
			])
			->get();
	}

	public function getLegionMembersCount($legionid)
	{
		return $this->legions
			->leftJoin('legion_members', 'legions.id', '=', 'legion_members.legion_id')
			->leftJoin('players', 'legion_members.player_id', '=', 'players.id')
			->where('legion_members.legion_id', $legionid)
			->count();
	}

	public function getKinah($limit = 100)
	{
		return $this->inventory
			->leftJoin('players', 'inventory.item_owner', '=', 'players.id')
			->where('inventory.item_id', 182400001)
			->where('players.name', '<>', '')
			->orderBy('inventory.item_count', 'desc')
			->take($limit)
			->select([
				'inventory.item_id',
				'inventory.item_count',
				'inventory.item_owner',
				'players.id',
				'players.name',
				'players.exp',
				'players.gender',
				'players.race',
				'players.player_class',
				'players.world_id',
				'players.online'
			])
			->get();
	}

	public function getKinahFilterBy($limit = 100, $filter)
	{
		$race = $filter == 'asmo' ? 'ASMODIANS' : 'ELYOS';

		return $this->inventory
			->leftJoin('players', 'inventory.item_owner', '=', 'players.id')
			->where('inventory.item_id', 182400001)
			->where('players.name', '<>', '')
			->where('players.race', $race)
			->orderBy('inventory.item_count', 'desc')
			->take($limit)
			->select([
				'inventory.item_id',
				'inventory.item_count',
				'inventory.item_owner',
				'players.id',
				'players.name',
				'players.exp',
				'players.gender',
				'players.race',
				'players.player_class',
				'players.world_id',
				'players.online'
			])
			->get();
	}
}