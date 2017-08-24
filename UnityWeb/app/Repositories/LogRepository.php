<?php

namespace App\Repositories;

use Auth;
use Log;
use Carbon;
use Settings;
use App\Models\LogWebshop;
use App\Models\LogDonate;
use App\Models\LogMembership;
use App\Models\LogAccountUpdate;
use App\Models\LogToolsSendItem;
use App\Models\LogUnstuck;
use App\Models\LogOnlineCount;
use App\Repositories\StatusRepositoryInterface;

class LogRepository implements LogRepositoryInterface {

	protected $webshop;

	protected $donate;

	protected $membership;

	protected $accountUpdate;

	protected $toolsSendItem;

	protected $unstuck;

	protected $onlineCount;

	protected $status;

	public function __construct(
		LogWebshop $webshop,
		LogDonate $donate,
		LogMembership $membership,
		LogAccountUpdate $accountUpdate,
		LogToolsSendItem $toolsSendItem,
		LogUnstuck $unstuck,
		LogOnlineCount $onlineCount,
		StatusRepositoryInterface $status)
	{
		$this->webshop = $webshop;

		$this->donate = $donate;

		$this->membership = $membership;

		$this->accountUpdate = $accountUpdate;

		$this->toolsSendItem = $toolsSendItem;

		$this->unstuck = $unstuck;

		$this->onlineCount = $onlineCount;

		$this->status = $status;
	}

	public function getWebshopPurchaseByAccount($account)
	{
		return $this->webshop
			->where('account_id', '=', $account)
			->orderBy('created_at', 'desc')
			->select([
				'account_id',
				'player_id',
				'item',
				'amount',
				'price',
				'enchant',
				'temperance',
				'created_at'
			])
			->get();
	}

	public function logWebshop($player, $item)
	{
		return $this->webshop
			->create([
				'account_id'	=>	$player['account_id'],
				'player_id'		=>	$player['id'],
				'item'			=>	$item['item_id'],
				'amount'		=>	$item['amount'],
				'enchant'		=>	$item['enchant'],
				'temperance'	=>	$item['temperance'],
				'price'			=>	$item['price']
			]);
	}

	public function logDonatePaypal($response, $amount)
	{
		return $this->donate
			->create([
				'invoice'	=>	sha1(Auth::user()->id.Carbon::now()),
				'account'	=>	Auth::user()->id,
				'usd'		=>	$response['PAYMENTINFO_0_AMT'],
				'amount'	=>	$amount,
				'status'	=>	$response['PAYMENTINFO_0_ACK'],
				'message'	=>  json_encode($response),
				'read'		=>	0,
				'type'		=>	'PAYPAL'
			]);
	}

	public function logDonatePaymentWall($response, $amount)
	{
		return $this->donate
			->create([
				'invoice'	=>	sha1(Auth::user()->id.Carbon::now()),
				'account'	=>	Auth::user()->id,
				'amount'	=>	$amount,
				'read'		=>	0,
				'status'	=>	'SUCCESS',
				'type'		=>	'PAYMENTWALL'
			]);
	}

	public function logMembership($account, $type, $duration, $price)
	{
		return $this->membership
			->create([
				'account_id'	=>	$account,
				'type'			=>	$type,
				'duration'		=>	$duration,
				'price'			=>	$price,
				'read'			=>	0,
			]);
	}

	public function logMessage($type, $message)
	{
		return Log::info($type, ['content' => $message]);
	}

	public function logAccountUpdate($account, $request)
	{
		return $this->accountUpdate
			->create([
				'account_id'				=>	$account['id'],
				'status'					=>	$request['status'],
				'email'						=>	$request['email'],
				'email_previous'			=>	empty($account['email']) ? $request['email'] : $account['email'],
				'toll'						=>	$request['toll'],
				'toll_previous'				=>	empty($account['toll']) ? 0 : $account['toll'],
				'donate_points'				=>	$request['credit_points'],
				'donate_points_previous'	=>	empty($account['donate_points']) ? 0 : $account['donate_points'],
				'access_level'				=>	$request['permissions'] == -1 ? $account['access_level'] : $request['permissions'],
				'access_level_previous'		=>	$account['access_level'],
				'privilege'					=>	$request['privileges'],
				'privilege_previous'		=>	$account['membership'],
				'updated_by'				=>	Auth::user()->id
			]);
	}


	public function getAccountUpdates($paginate = 50)
	{
		return $this->accountUpdate
			->leftJoin('account_data', 'account_data.id', '=', 'cms_log_account_update.account_id')
			->leftJoin('account_data as updater', 'updater.id', '=', 'cms_log_account_update.updated_by')
			->orderBy('cms_log_account_update.created_at', 'desc')
			->select([
				'cms_log_account_update.account_id',
				'cms_log_account_update.status',
				'cms_log_account_update.email',
				'cms_log_account_update.email_previous',
				'cms_log_account_update.toll',
				'cms_log_account_update.toll_previous',
				'cms_log_account_update.donate_points',
				'cms_log_account_update.donate_points_previous',
				'cms_log_account_update.access_level',
				'cms_log_account_update.access_level_previous',
				'cms_log_account_update.privilege',
				'cms_log_account_update.privilege_previous',
				'account_data.name',
				'updater.id as updater_id',
				'updater.name as updater_name'
			])
			->paginate($paginate);
	}

	public function filterAccountUpdates($accountName, $paginate = 50)
	{
		return $this->accountUpdate
			->leftJoin('account_data', 'account_data.id', '=', 'cms_log_account_update.account_id')
			->leftJoin('account_data as updater', 'updater.id', '=', 'cms_log_account_update.updated_by')
			->orderBy('cms_log_account_update.created_at', 'desc')
			->select([
				'cms_log_account_update.account_id',
				'cms_log_account_update.status',
				'cms_log_account_update.email',
				'cms_log_account_update.email_previous',
				'cms_log_account_update.toll',
				'cms_log_account_update.toll_previous',
				'cms_log_account_update.donate_points',
				'cms_log_account_update.donate_points_previous',
				'cms_log_account_update.access_level',
				'cms_log_account_update.access_level_previous',
				'cms_log_account_update.privilege',
				'cms_log_account_update.privilege_previous',
				'account_data.name',
				'updater.id as updater_id',
				'updater.name as updater_name'
			])
			->where('account_data.name', $accountName)
			->paginate($paginate);
	}

	public function getAccountUpdatesCount()
	{
		return $this->accountUpdate->where('read', 0)->count();
	}

	public function updateAccountUpdatestoRead()
	{
		return $this->accountUpdate->where('read', 0)->update(['read' => 1]);
	}

	public function getWebshopPurchase($paginate = 50)
	{
		return $this->webshop
			->leftJoin('account_data', 'cms_log_webshop.account_id', '=', 'account_data.id')
			->orderBy('cms_log_webshop.created_at', 'desc')
			->select([
				'account_data.name',
				'cms_log_webshop.account_id',
				'cms_log_webshop.player_id',
				'cms_log_webshop.item',
				'cms_log_webshop.amount',
				'cms_log_webshop.price',
				'cms_log_webshop.enchant',
				'cms_log_webshop.temperance'
			])
			->paginate($paginate);
	}

	public function filterWebshopPurchase($accountName, $paginate = 50)
	{
		return $this->webshop
			->leftJoin('account_data', 'cms_log_webshop.account_id', '=', 'account_data.id')
			->orderBy('cms_log_webshop.created_at', 'desc')
			->select([
				'account_data.name',
				'cms_log_webshop.account_id',
				'cms_log_webshop.player_id',
				'cms_log_webshop.item',
				'cms_log_webshop.amount',
				'cms_log_webshop.price',
				'cms_log_webshop.enchant',
				'cms_log_webshop.temperance'
			])
			->where('account_data.name', $accountName)
			->paginate($paginate);
	}

	public function getWebshopUnreadCount()
	{
		return $this->webshop->where('read', 0)->count();
	}

	public function updateWebshoptoRead()
	{
		return $this->webshop->where('read', 0)->update(['read' => 1]);
	}

	public function getDonate($paginate = 50)
	{
		return $this->donate
			->leftJoin('account_data', 'cms_log_donate.account', '=', 'account_data.id')
			->orderBy('cms_log_donate.created_at', 'desc')
			->select([
				'cms_log_donate.id',
				'account_data.name',
				'cms_log_donate.account',
				'cms_log_donate.usd',
				'cms_log_donate.status',
				'cms_log_donate.invoice',
				'cms_log_donate.amount',
				'cms_log_donate.type'
			])
			->paginate($paginate);
	}

	public function filterDonate($accountName, $paginate = 50)
	{
		return $this->donate
			->leftJoin('account_data', 'cms_log_donate.account', '=', 'account_data.id')
			->orderBy('cms_log_donate.created_at', 'desc')
			->select([
				'cms_log_donate.id',
				'account_data.name',
				'cms_log_donate.account',
				'cms_log_donate.usd',
				'cms_log_donate.status',
				'cms_log_donate.invoice',
				'cms_log_donate.amount',
				'cms_log_donate.type'
			])
			->where('account_data.name', $accountName)
			->paginate($paginate);
	}

	public function getDonateInfo($id)
	{
		return $this->donate
			->where('cms_log_donate.id', $id)
			->leftJoin('account_data', 'cms_log_donate.account', '=', 'account_data.id')
			->select([
				'cms_log_donate.id',
				'account_data.name',
				'cms_log_donate.account',
				'cms_log_donate.usd',
				'cms_log_donate.status',
				'cms_log_donate.message'
			])
			->first();
	}

	public function getDonateUnreadCount()
	{
		return $this->donate->where('read', 0)->count();
	}

	public function updateDonatetoRead()
	{
		return $this->donate->where('read', 0)->update(['read' => 1]);
	}

	public function getMembershipPurchase($paginate = 25)
	{
		return $this->membership
			->leftJoin('account_data', 'cms_log_membership.account_id', '=', 'account_data.id')
			->orderBy('cms_log_membership.created_at', 'desc')
			->select([
				'account_data.name',
				'cms_log_membership.account_id',
				'cms_log_membership.type',
				'cms_log_membership.duration',
				'cms_log_membership.price',
			])
			->paginate($paginate);
	}

	public function filterMembershipPurchase($accountName, $paginate = 25)
	{
		return $this->membership
			->leftJoin('account_data', 'cms_log_membership.account_id', '=', 'account_data.id')
			->orderBy('cms_log_membership.created_at', 'desc')
			->select([
				'account_data.name',
				'cms_log_membership.account_id',
				'cms_log_membership.type',
				'cms_log_membership.duration',
				'cms_log_membership.price',
			])
			->where('account_data.name', $accountName)
			->paginate($paginate);
	}

	public function getMembershipUnreadCount()
	{
		return $this->membership->where('read', 0)->count();
	}

	public function updateMembershiptoRead()
	{
		return $this->membership->where('read', 0)->update(['read' => 1]);
	}

	public function logToolsSendItem($request, $playerid)
	{
		return $this->toolsSendItem
			->create([
				'item_id'		=> 	$request['item_id'],
				'quantity'		=>	$request['quantity'],
				'enchant'		=>	$request['enchant'],
				'temperance'	=>	$request['temperance'],
				'sent_at'		=>	Carbon::now(),
				'player_id'		=>	$playerid,
				'sender'		=>	Auth::user()->id
			]);
	}

	public function getLogToolsSendItem($paginate = 25)
	{
		return $this->toolsSendItem
			->leftJoin('account_data', 'cms_log_tools_senditem.sender', '=', 'account_data.id')
			->select([
				'account_data.name',
				'cms_log_tools_senditem.item_id',
				'cms_log_tools_senditem.quantity',
				'cms_log_tools_senditem.enchant',
				'cms_log_tools_senditem.temperance',
				'cms_log_tools_senditem.sent_at',
				'cms_log_tools_senditem.player_id',
				'cms_log_tools_senditem.sender',
				'cms_log_tools_senditem.read',
			])
			->orderBy('sent_at', 'desc')
			->paginate($paginate);
	}

	public function filterLogToolsSendItem($accountName, $paginate = 25)
	{
		return $this->toolsSendItem
			->leftJoin('account_data', 'cms_log_tools_senditem.sender', '=', 'account_data.id')
			->select([
				'account_data.name',
				'cms_log_tools_senditem.item_id',
				'cms_log_tools_senditem.quantity',
				'cms_log_tools_senditem.enchant',
				'cms_log_tools_senditem.temperance',
				'cms_log_tools_senditem.sent_at',
				'cms_log_tools_senditem.player_id',
				'cms_log_tools_senditem.sender',
				'cms_log_tools_senditem.read',
			])
			->orderBy('sent_at', 'desc')
			->where('account_data.name', $accountName)
			->paginate($paginate);
	}

	public function filterLogToolsSendItemPlayerId($playerid, $paginate = 25)
	{
		return $this->toolsSendItem
			->leftJoin('account_data', 'cms_log_tools_senditem.sender', '=', 'account_data.id')
			->select([
				'account_data.name',
				'cms_log_tools_senditem.item_id',
				'cms_log_tools_senditem.quantity',
				'cms_log_tools_senditem.enchant',
				'cms_log_tools_senditem.temperance',
				'cms_log_tools_senditem.sent_at',
				'cms_log_tools_senditem.player_id',
				'cms_log_tools_senditem.sender',
				'cms_log_tools_senditem.read',
			])
			->orderBy('sent_at', 'desc')
			->where('cms_log_tools_senditem.player_id', $playerid)
			->paginate($paginate);
	}

	public function getLogToolsSendItemUnreadCount()
	{
		return $this->toolsSendItem->where('read', 0)->count();
	}

	public function updateLogToolsSendItemtoRead()
	{
		return $this->toolsSendItem->where('read', 0)->update(['read' => 1]);
	}

	public function createUnstuckLog($accountid)
	{
		return $this->unstuck
			->create([
				'account_id'	=>	$accountid,
				'expire'		=>	Carbon::now()->addMinutes(Settings::general()->unlock_unstuck)
			]);
	}

	public function findUnstuckLog($accountid)
	{
		return $this->unstuck->where('account_id', $accountid)->first();
	}

	public function updateUnstuckLog($accountid)
	{
		return $this->unstuck
			->where('account_id', $accountid)
			->update([
				'expire'		=>	Carbon::now()->addMinutes(Settings::general()->unlock_unstuck)
			]);
	}

	public function findOnlineLogCount($id)
	{
		return $this->onlineCount->find($id);
	}

	public function updateOnlineLogCount($id, $onlineCount)
	{
		return $this->onlineCount
			->where('id', $id)
			->update([
				'online_count'	=> $onlineCount
			]);
	}

	public function onlinePeakCount()
	{
		$peak = $this->findOnlineLogCount(1);

		$currentOnlineCount = $this->status->getOnlineCount();

		if ($peak->online_count < $currentOnlineCount)
		{
			$this->updateOnlineLogCount(1, $currentOnlineCount);

			return $currentOnlineCount;
		}
		else
		{
			return $peak->online_count;
		}
	}

	public function onlinePeakCount24Hrs()
	{
		$peak = $this->findOnlineLogCount(2);

		$dateNow = Carbon::now()->toDateString();
		$peakDate = Carbon::parse($peak->updated_at)->toDateString();

		if ($dateNow > $peakDate)
		{
			$currentOnlineCount = $this->status->getOnlineCount();

			$this->updateOnlineLogCount(2, $currentOnlineCount);

			return $currentOnlineCount;
		}
		else
		{
			return $peak->online_count;
		}
	}
}