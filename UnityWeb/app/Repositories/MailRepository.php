<?php namespace App\Repositories;

use DB;
use App\Models\Mail;

class MailRepository implements MailRepositoryInterface {

	protected $mail;

	protected $inventory;

	public function __construct(Mail $mail, InventoryRepositoryInterface $inventory)
	{
		$this->mail = $mail;

		$this->inventory = $inventory;
	}

	public function getMailUniqueId()
	{
		return $this->mail
			->select([
				DB::raw('MAX(mail_unique_id) as mail_unique_id')
			])
			->first();
	}

	public function create($player, $webItem)
	{
		$lastMailId = $this->getMailUniqueId();

		if(substr($lastMailId->mail_unique_id, -1) == 8)
		{
			$lastMailId = $lastMailId->mail_unique_id + 3;
		}
		elseif (substr($lastMailId->mail_unique_id, -1) == 9)
		{
			$lastMailId = $lastMailId->mail_unique_id + 2;
		}
		else
		{
			$lastMailId = $lastMailId->mail_unique_id + 1;
		}

		if ($webItem['item_id'] == 182400001)
		{
			$attachedItemId = 0;
			$attachedKinahCount = $webItem['amount'];
		}
		else
		{
			// 127 - Item in mail
			// 0 - Item in inventory
			$item = $this->inventory->create($webItem['item_id'], $player['id'], $webItem['amount'], 127, $webItem['enchant'], $webItem['temperance']);

			$attachedItemId = $item->item_unique_id;
			$attachedKinahCount = 0;
		}

		return $this->mail
			->create([
				'mail_unique_id'		=>	$this->getMailUniqueId()->mail_unique_id + 1,
				'mail_recipient_id'		=>	$player['id'],
				'sender_name'			=>	'Admin',
				'mail_title'			=>	'Webshop Delivery',
				'mail_message'			=>	'Thank you for purchasing.',
				'unread'				=>	1,
				'attached_item_id'		=>	$attachedItemId,
				'attached_kinah_count'	=>	$attachedKinahCount,
				'express'				=>	1
			]);
	}

	public function toolsCreate($request, $player)
	{
		if ($request['item_id'] == 182400001)
		{
			$lastMailId = $this->getMailUniqueId();

			if(substr($lastMailId->mail_unique_id, -1) == 8)
			{
				$lastMailId = $lastMailId->mail_unique_id + 3;
			}
			elseif (substr($lastMailId->mail_unique_id, -1) == 9)
			{
				$lastMailId = $lastMailId->mail_unique_id + 2;
			}
			else
			{
				$lastMailId = $lastMailId->mail_unique_id + 1;
			}

			$attachedItemId = 0;
			$attachedKinahCount = $request['quantity'];

			return $this->mail
				->create([
					'mail_unique_id'		=>	$this->getMailUniqueId()->mail_unique_id + 1,
					'mail_recipient_id'		=>	$player->id,
					'sender_name'			=>	'Admin',
					'mail_title'			=>	'Admin Mail Delivery',
					'mail_message'			=>	'Sent by Admin.',
					'unread'				=>	1,
					'attached_item_id'		=>	$attachedItemId,
					'attached_kinah_count'	=>	$attachedKinahCount,
					'express'				=>	1
				]);
		}
		elseif ($request['stackable'] == 0)
		{
			if ($request['quantity'] > 1)
			{
				for ($i = 1; $i <= $request['quantity']; $i++)
				{
					$lastMailId = $this->getMailUniqueId();

					if(substr($lastMailId->mail_unique_id, -1) == 8)
					{
						$lastMailId = $lastMailId->mail_unique_id + 3;
					}
					elseif (substr($lastMailId->mail_unique_id, -1) == 9)
					{
						$lastMailId = $lastMailId->mail_unique_id + 2;
					}
					else
					{
						$lastMailId = $lastMailId->mail_unique_id + 1;
					}

					// 127 - Item in mail
					// 0 - Item in inventory
					$item = $this->inventory->toolsCreate($request['item_id'], $player->id, 1, 127, $request['enchant'], $request['temperance'], $request['amplify']);

					$attachedItemId = $item->item_unique_id;
					$attachedKinahCount = 0;

					$this->mail
						->create([
							'mail_unique_id'		=>	$this->getMailUniqueId()->mail_unique_id + 1,
							'mail_recipient_id'		=>	$player->id,
							'sender_name'			=>	'Admin',
							'mail_title'			=>	'Admin Mail Delivery',
							'mail_message'			=>	'Sent by Admin.',
							'unread'				=>	1,
							'attached_item_id'		=>	$attachedItemId,
							'attached_kinah_count'	=>	$attachedKinahCount,
							'express'				=>	1
						]);
				}

				return true;
			}
			else
			{
				$lastMailId = $this->getMailUniqueId();

				if(substr($lastMailId->mail_unique_id, -1) == 8)
				{
					$lastMailId = $lastMailId->mail_unique_id + 3;
				}
				elseif (substr($lastMailId->mail_unique_id, -1) == 9)
				{
					$lastMailId = $lastMailId->mail_unique_id + 2;
				}
				else
				{
					$lastMailId = $lastMailId->mail_unique_id + 1;
				}

				// 127 - Item in mail
				// 0 - Item in inventory
				$item = $this->inventory->toolsCreate($request['item_id'], $player->id, $request['quantity'], 127, $request['enchant'], $request['temperance'], $request['amplify']);

				$attachedItemId = $item->item_unique_id;
				$attachedKinahCount = 0;

				return $this->mail
					->create([
						'mail_unique_id'		=>	$this->getMailUniqueId()->mail_unique_id + 1,
						'mail_recipient_id'		=>	$player->id,
						'sender_name'			=>	'Admin',
						'mail_title'			=>	'Admin Mail Delivery',
						'mail_message'			=>	'Sent by Admin.',
						'unread'				=>	1,
						'attached_item_id'		=>	$attachedItemId,
						'attached_kinah_count'	=>	$attachedKinahCount,
						'express'				=>	1
					]);
			}

		}
		else
		{
			$lastMailId = $this->getMailUniqueId();

			if(substr($lastMailId->mail_unique_id, -1) == 8)
			{
				$lastMailId = $lastMailId->mail_unique_id + 3;
			}
			elseif (substr($lastMailId->mail_unique_id, -1) == 9)
			{
				$lastMailId = $lastMailId->mail_unique_id + 2;
			}
			else
			{
				$lastMailId = $lastMailId->mail_unique_id + 1;
			}

			// 127 - Item in mail
			// 0 - Item in inventory
			$item = $this->inventory->toolsCreate($request['item_id'], $player->id, $request['quantity'], 127, $request['enchant'], $request['temperance'], $request['amplify']);

			$attachedItemId = $item->item_unique_id;
			$attachedKinahCount = 0;

			return $this->mail
				->create([
					'mail_unique_id'		=>	$this->getMailUniqueId()->mail_unique_id + 1,
					'mail_recipient_id'		=>	$player->id,
					'sender_name'			=>	'Admin',
					'mail_title'			=>	'Admin Mail Delivery',
					'mail_message'			=>	'Sent by Admin.',
					'unread'				=>	1,
					'attached_item_id'		=>	$attachedItemId,
					'attached_kinah_count'	=>	$attachedKinahCount,
					'express'				=>	1
				]);
		}
	}
}