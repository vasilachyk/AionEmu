<?php

namespace App\Http\Controllers;

use Auth;
use Carbon;
use Settings;
use Illuminate\Http\Request;
use App\Http\Requests\Postback;
use App\Repositories\PlayerRepositoryInterface;
use App\Repositories\LegionRepositoryInterface;
use App\Repositories\InventoryRepositoryInterface;
use App\Repositories\PaymentRepositoryInterface;
use App\Repositories\AccountRepositoryInterface;
use App\Repositories\VoteRepositoryInterface;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	protected $players;

	protected $legions;

	protected $inventory;

	protected $payment;

	protected $account;

	protected $vote;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(PlayerRepositoryInterface $players, LegionRepositoryInterface $legions, InventoryRepositoryInterface $inventory, PaymentRepositoryInterface $payment, AccountRepositoryInterface $account, VoteRepositoryInterface $vote)
	{
		$this->players = $players;

		$this->legions = $legions;

		$this->inventory = $inventory;

		$this->payment = $payment;

		$this->account = $account;

		$this->vote = $vote;
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		if (Auth::check())
		{
			\Log::info('voted ip : ' . $request->ip());

			$referer = $request->server('HTTP_REFERER');

			if ( ! empty($referer))
			{
				$site = $this->vote->findByAddress(parse_url($referer, PHP_URL_HOST));
			}
			else
			{
				$site = '';
			}

			if ($request->session()->has('vsiteid') && $request->session()->has('vuserip'))
			{
				if ( ! empty($request->session()->get('vsiteid')) && ! empty($request->session()->get('vuserip')) )
				{
						if ($site)
						{
							if (Settings::general()->vote_ip_blocking)
							{
								$clientIp = $request->ip();

								$siteBlocked = $this->vote->findVoteLogIpBlocking($site->id, $clientIp);

								if (empty($siteBlocked))
								{
									$voter = $this->vote->findLogWithIp($site->id, $clientIp);

									if ( ! $voter)
									{
										$vote = $this->vote->voteCreate($site);

										if (Settings::general()->vote_type == 'CREDITS')
										{
											if (strpos($referer, parse_url($site->address, PHP_URL_HOST)) !== false)
											{
												$this->account->updateDonatePoints($request->user()->id, $site->points, '+');
											}
										}
										else
										{
											if (strpos($referer, parse_url($site->address, PHP_URL_HOST)) !== false)
											{
												$this->account->updateToll($request->user()->id, $site->points, '+');
											}
										}
									}
									else
									{
										$vote = $this->vote->voteUpdate($site);

										if (Settings::general()->vote_type == 'CREDITS')
										{
											if (strpos($referer, parse_url($site->address, PHP_URL_HOST)) !== false)
											{
												$this->account->updateDonatePoints($request->user()->id, $site->points, '+');
											}
										}
										else
										{
											if (strpos($referer, parse_url($site->address, PHP_URL_HOST)) !== false)
											{
												$this->account->updateToll($request->user()->id, $site->points, '+');
											}
										}
									}
								}

								$request->session()->forget('vsiteid');
								$request->session()->forget('vuserip');

								return redirect()->action('VoteController@getIndex');

							}
							else
							{
								$voter = $this->vote->findLog($site->id, $request->user()->id);

								if ( ! $voter)
								{
									$vote = $this->vote->voteCreate($site);

									if (Settings::general()->vote_type == 'CREDITS')
									{
										if (strpos($referer, parse_url($site->address, PHP_URL_HOST)) !== false)
										{
											$this->account->updateDonatePoints($request->user()->id, $site->points, '+');
										}
									}
									else
									{
										if (strpos($referer, parse_url($site->address, PHP_URL_HOST)) !== false)
										{
											$this->account->updateToll($request->user()->id, $site->points, '+');
										}
									}
								}
								else
								{
									if ($voter->unblock_time < Carbon::now())
									{
										$vote = $this->vote->voteUpdate($site);

										if (Settings::general()->vote_type == 'CREDITS')
										{
											if (strpos($referer, parse_url($site->address, PHP_URL_HOST)) !== false)
											{
												$this->account->updateDonatePoints($request->user()->id, $site->points, '+');
											}
										}
										else
										{
											if (strpos($referer, parse_url($site->address, PHP_URL_HOST)) !== false)
											{
												$this->account->updateToll($request->user()->id, $site->points, '+');
											}
										}
									}
								}

								$request->session()->forget('vsiteid');
								$request->session()->forget('vuserip');

								return redirect()->action('VoteController@getIndex');
							}
						}
				}
			}

		}

		return view('pages.main.index');
	}

	public function download()
	{
		return view('pages.main.download');
	}

	public function info()
	{
		return view('pages.main.info');
	}

	public function guide()
	{
		return view('pages.main.guide');
	}

	public function staff()
	{
		return view('pages.main.staff');
	}

	public function faq()
	{
		return view('pages.main.faq');
	}

	public function onlinePlayers()
	{
		$data = [
			'onlinePlayers' => $this->players->getOnline()
		];

		return view('pages.player.online-players', $data);
	}

	public function player($id)
	{
		if (Auth::check())
		{
			$data = [
				'player' => $this->players->getPlayerInfo($id),
				'inventory_items' => $this->inventory->getPlayerInventory($id, Auth::user()->id)
			];
		}
		else
		{
			$data = [
				'player' => $this->players->getPlayerInfo($id),
				'inventory_items' => $this->inventory->getPlayerInventory($id, 0)
			];
		}

		return view('pages.player.player-info', $data);
	}

	public function legion($id)
	{
	    $members = $this->legions->getLegionMembers($id);

		$data = [
			'legion' 	=> 	$this->legions->getLegionInfo($id),
			'members'	=>	$this->legions->getLegionMembers($id)
		];

		return view('pages.legion.legion-info', $data);
	}

	public function pingback(Request $request)
	{
		$path = base_path('resources/assets/paymentwall/lib/');
		require($path . 'paymentwall.php');

		\PaymentWall_Config::getInstance()->set([
			'api_type'		=> 	\Paymentwall_Config::API_VC,
			'public_key'	=>	Settings::payment()->paymentwall_public_key,
			'private_key'	=>	Settings::payment()->paymentwall_private_key
		]);

		$pingback = new \PaymentWall_Pingback($_GET, $request->ip());

		if ($pingback->validate(true))
		{
			$virtualCurrency = $pingback->getVirtualCurrencyAmount();

			if ($pingback->isDeliverable())
			{
				$times = Settings::payment()->donate_rates == 0 ?  1 : Settings::payment()->donate_rates;

				if ($virtualCurrency >= 0)
				{
					$rawDonate = $virtualCurrency * $times;
					$donatePoints = $virtualCurrency * $times;
				}
				else
				{
					$rawDonate = $virtualCurrency;
					$donatePoints = str_replace('-', '', $virtualCurrency);
				}

				$createTransaction = $this->payment->paymentWallCreateTransactionLog(sha1($request->get('uid').Carbon::now()), $request->get('uid'), $rawDonate);

				if (Settings::general()->donate_type == 'CREDITS')
				{
					if ($virtualCurrency >= 0)
					{
						$this->account->updateDonatePoints($request->get('uid'), $donatePoints, '+');
					}
					else
					{
						$this->account->updateDonatePoints($request->get('uid'), $donatePoints, '-');
					}
				}
				else
				{
					if ($virtualCurrency >= 0)
					{
						$this->account->updateToll($request->get('uid'), $donatePoints, '+');
					}
					else
					{
						$this->account->updateToll($request->get('uid'), $donatePoints, '-');
					}
				}
			}
			elseif ($pingback->isCancelable())
			{
				$donatePoints = str_replace('-', '', $virtualCurrency);

				if (Settings::general()->donate_type == 'CREDITS')
				{
					$this->account->updateDonatePoints($request->get('uid'), $donatePoints, '-');
				}
				else
				{
					$this->account->updateToll($request->get('uid'), $donatePoints, '-');
				}
			}

			echo 'OK'; // Paymentwall expects response to be OK, otherwise the pingback will be resent
		}
		else
		{
			\Log::info($pingback->getErrorSummary());
		}
	}

	public function postback(Request $request)
	{
		$id = $request->get('id'); // ID of this transaction.
		$uid = $request->get('uid'); // ID of the user which performed this transaction. 
		$oid = $request->get('oid'); // ID of the offer or direct payment method.
		$new = $request->get('new'); // Number of in-game currency your user has earned by completing this offer.
		$total = $request->get('total'); // Total number of in-game currency your user has earned on this App.
		$sig = $request->get('sig'); // Security hash used to verify the authenticity of the postback.

		if(!(is_numeric($id) && is_numeric($uid) && is_numeric($oid) && is_numeric($new) && is_numeric($total))) exit('0'); // Fail.

		$result = 1;

		$sigCompare = md5($id.':'.$new.':'.$uid.':'.Settings::payment()->super_rewards_private_key);

		if ($sig == $sigCompare)
		{
			$createTransaction = $this->payment->superRewardsCreateTransactionLog($id, $uid, $oid, $new);

			if ( ! $createTransaction) $result = 0;

			$times = Settings::payment()->donate_rates == 0 ?  1 : Settings::payment()->donate_rates;

			if (Settings::general()->donate_type == 'CREDITS')
			{
				$donatePoints = $new * $times;

				$this->account->updateDonatePoints($uid, $donatePoints, '+');

				$result = 1;
			}
			else
			{
				$toll = $new * $times;

				$this->account->updateToll($uid, $toll, '+');

				$result = 1;
			}
		}
		else
		{
			$result = 0;
		}

		return $result;
	}
}
