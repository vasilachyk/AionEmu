<?php namespace App\Repositories;

use App\Models\Legions;

class LegionRepository implements LegionRepositoryInterface {

	protected $legion;

	public function __construct(Legions $legion)
	{
		$this->legion = $legion;
	}

	public function getLegionInfo($id)
	{
		return $this->legion
			->leftJoin('legion_members', 'legions.id', '=', 'legion_members.legion_id')
			->leftJoin('players', 'legion_members.player_id', '=', 'players.id')
			->where('legion_members.rank', 'BRIGADE_GENERAL')
			->where('legions.id', $id)
			->select([
				'players.name as players_name',
				'players.id as playerid',
				'legions.id',
				'legions.name',
				'legions.level',
				'players.race',
				'legions.contribution_points'
			])
			->first();
	}

	public function getLegionMembers($id, $paginate = 5)
	{
		return $this->legion
			->leftJoin('legion_members', 'legions.id', '=', 'legion_members.legion_id')
			->leftJoin('players', 'legion_members.player_id', '=', 'players.id')
			->where('legions.id', $id)
			->orderBy('players.exp', 'desc')
			->select([
				'players.name',
				'players.id',
				'players.exp',
				'players.gender',
				'players.player_class',
				'players.world_id',
				'players.title_id',
				'players.online',
				'legion_members.rank'
			])
            ->paginate($paginate);

	}

	public function getLegionMembersCount($id)
	{
		return $this->legion
			->leftJoin('legion_members', 'legions.id', '=', 'legion_members.legion_id')
			->leftJoin('players', 'legion_members.player_id', '=', 'legions.id')
			->where('legion_members.legion_id', $id)
			->count();
	}
}