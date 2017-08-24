<?php

namespace App\Repositories;

use DB;
use App\Models\Inventory;

class InventoryRepository implements InventoryRepositoryInterface {

	protected $inventory;

	public function __construct(Inventory $inventory)
	{
		$this->inventory = $inventory;
	}

	public function findPlayerItemByItemId($itemid, $playerid)
	{
		return $this->inventory
			->leftJoin('players', 'players.id', '=', 'inventory.item_owner')
			->where('item_id', $itemid)
			->where('item_owner', '=', $playerid)
			->select([
				'item_unique_id',
				'item_id',
				'item_count',
				'item_owner'
			])
			->get();
	}

	public function findPlayerItemByItemUniqueId($itemid, $playerid)
	{
		return $this->inventory
			->leftJoin('players', 'players.id', '=', 'inventory.item_owner')
			->where('item_unique_id', $itemid)
			->where('item_owner', '=', $playerid)
			->select([
				'item_unique_id',
				'item_id',
				'item_count',
				'item_owner'
			])
			->first();
	}

	public function getPlayerInventory($player, $accountId)
	{
		return $this->inventory
			->leftJoin('players', 'players.id', '=', 'inventory.item_owner')
			->where('item_owner', '=', $player)
			->where('players.account_id', '=', $accountId)
			->select([
				'item_unique_id',
				'item_id',
				'item_count',
				'item_owner'
			])
			->get();
	}

	public function getItemUniqueId()
	{
		return $this->inventory
			->select([
				DB::raw('MAX(item_unique_id) as item_unique_id')
			])
			->first();
	}

	public function create($itemId, $itemOwner, $amount, $itemlocation, $enchant, $authorize)
	{
		// $lastItemId = $this->getItemUniqueId();

		return $this->inventory
			->create([
				'item_id'			=> 	$itemId,
				'item_owner'		=>	$itemOwner,
				'item_creator'		=>	'',
				'item_count'		=>	$amount,
				'item_unique_id'	=>	$this->getItemUniqueId()->item_unique_id + 1,
				'item_skin'			=>	$itemId,
				'item_location'		=>	$itemlocation,
				'enchant'			=>	$enchant,
				'authorize'			=>	$authorize
			]);
	}

	public function toolsCreate($itemId, $itemOwner, $amount, $itemlocation, $enchant, $authorize, $amplify)
	{
		// $lastItemId = $this->getItemUniqueId();

		return $this->inventory
			->create([
				'item_id'			=> 	$itemId,
				'item_owner'		=>	$itemOwner,
				'item_creator'		=>	'',
				'item_count'		=>	$amount,
				'item_unique_id'	=>	$this->getItemUniqueId()->item_unique_id + 1,
				'item_skin'			=>	$itemId,
				'item_location'		=>	$itemlocation,
				'enchant'			=>	$enchant,
				'authorize'			=>	$authorize,
				'is_amplified'		=>	$amplify
			]);
	}

	public function deleteItem($itemUniqueId, $ownerId)
	{
		return $this->inventory
			->where('item_unique_id', $itemUniqueId)
			->where('item_owner', $ownerId)
			->delete();
	}

	public function deleteAllItems($ownerId)
	{
		return $this->inventory
			->where('item_owner', $ownerId)
			->delete();
	}
}