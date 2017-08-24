<?php

namespace App\Http\Controllers;

use Auth;
use Carbon;
use Settings;
use Illuminate\Http\Request;
use App\Http\Requests\Purchase;
use App\Http\Controllers\Controller;
use App\Repositories\WebshopRepositoryInterface;
use App\Repositories\WebshopCategoryRepositoryInterface;
use App\Repositories\PlayerRepositoryInterface;
use App\Repositories\AccountRepositoryInterface;
use App\Repositories\InventoryRepositoryInterface;
use App\Repositories\MailRepositoryInterface;
use App\Repositories\LogRepositoryInterface;

class WebshopController extends Controller {

	protected $category;

	protected $webshop;

	protected $player;

	protected $account;

	protected $inventory;

	protected $log;

	public function __construct(
		WebshopCategoryRepositoryInterface $category,
		WebshopRepositoryInterface $webshop,
		PlayerRepositoryInterface $player,
		AccountRepositoryInterface $account,
		InventoryRepositoryInterface $inventory,
		MailRepositoryInterface $mail,
		LogRepositoryInterface $log
	)
	{
		$this->category = $category;

		$this->webshop = $webshop;

		$this->player = $player;

		$this->account = $account;

		$this->inventory = $inventory;

		$this->mail = $mail;

		$this->log = $log;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex(Request $request)
	{
		if ($request->get('itemname'))
		{
			$items = $this->webshop->filterByItemName($request->get('itemname'));
		}
		else
		{
			$items = $this->webshop->getAll();
		}

		$data = [
			'items'	=>	$items
		];

		return view('pages.webshop.index', $data);
	}

	public function getCategory($slug = null)
	{
		if (empty($slug)) return redirect()->action('WebshopController@getIndex');

		$category = $this->category->findBySlug($slug);

		if (empty($category)) return redirect()->action('WebshopController@getIndex')->with('failure', 'The selected category does not exists.');

		$data = [
			'category'	=>	$category,
			'items'		=>	$this->webshop->getByCategory($category->id)
		];

		return view('pages.webshop.category', $data);
	}

	public function getPurchase($id = null)
	{
		if (empty($id)) return redirect()->action('WebshopController@getIndex');

		$item = $this->webshop->find($id);

		if ( ! $item) return redirect()->action('WebshopController@getIndex')->with('failure', 'The selected item does not exists.');

		$data = [
			'item'		=>  $item,
			'players'	=>	$this->player->getPlayersByAccount(Auth::user()->id)
		];

		return view('pages.webshop.purchase', $data);
	}

	public function postPurchase(Purchase $request)
	{
		$player = $this->player->findWithAccountId($request->get('player'), Auth::user()->id);
		$item = $this->webshop->find($request->get('itemid'));

		if ( ! ($player && $item)) return redirect()->back()->with('failure', 'Unable to purchase the item.');

		$account = $this->account->find(Auth::user()->id);

		if (Settings::general()->donate_type == 'CREDITS')
		{
			if ($account->donate_points < $item->price) return redirect()->back()->with('failure', 'Insufficient '.Settings::general()->credits_name);
		}
		else
		{
			if ($account->toll < $item->price) return redirect()->back()->with('failure', 'Insufficient tolls.');
		}

		if ($player->online == 1) return redirect()->back()->with('failure', 'Please logout your character before purchasing the item.');

		$mail = $this->mail->create($player, $item);

		if ($mail)
		{
			if (Auth::user()->membership == 1 && Auth::user()->expire > Carbon::now()->toDateString())
			{
				$discount = ($item->price / 100) * Settings::general()->webshop_discount_premium;
				$newPrice = $item->price - $discount;
			}
			elseif (Auth::user()->membership == 2 && Auth::user()->expire > Carbon::now()->toDateString())
			{
				$discount = ($item->price / 100) * Settings::general()->webshop_discount_vip;
				$newPrice = $item->price - $discount;
			}
			else
			{
				$discount = ($item->price / 100) * Settings::general()->webshop_discount_normal;
				$newPrice = $item->price - $discount;
			}

			if (Settings::general()->donate_type == 'CREDITS')
			{
				$account = $this->account->updateDonatePoints(Auth::user()->id, $newPrice, '-');
			}
			else
			{
				$account = $this->account->updateToll(Auth::user()->id, $newPrice, '-');
			}

			$this->log->logWebshop($player, $item);

			return redirect()->back()->with('success', 'Purchase Successful.');
		}

		return redirect()->back()->with('failure', 'Unable to purchase the item.');
	}

}
