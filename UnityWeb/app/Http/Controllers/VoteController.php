<?php

namespace App\Http\Controllers;

use Carbon;
use Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\VoteRepositoryInterface;
use App\Repositories\AccountRepositoryInterface;

class VoteController extends Controller {

	protected $vote;

	protected $account;

	public function __construct(VoteRepositoryInterface $vote, AccountRepositoryInterface $account)
	{
		$this->vote = $vote;

		$this->account = $account;
	}

	public function getIndex()
	{
		$data = [
			'sites'	=> $this->vote->all()
		];

		return view('pages.vote.index', $data);
	}

	public function postSite(Request $request)
	{
		if ($request->ajax())
		{
			$id = $request->get('sid');

			if (empty($id) || ! is_numeric($id)) return response()->json('Site not found.', 404);

			$site = $this->vote->find($id);

			if ( ! $site) return response()->json('Site not found.', 404);

			if (Settings::general()->vote_ip_blocking)
			{
				$clientIp = $request->ip();

				$siteBlocked = $this->vote->findVoteLogIpBlocking($site->id, $clientIp);

				if (empty($siteBlocked))
				{
					$voter = $this->vote->findLogWithIp($site->id, $clientIp);

					$request->session()->put('vsiteid', $site->id);
					$request->session()->put('vuserip', $clientIp);

					if ( ! $voter)
					{
						$vote = true;
					}
					else
					{
						$vote = true;
					}

					return $vote ? response()->json($site->address, 200) : response()->json('Unable to vote, please try again later.', 403);
				}

				if ($siteBlocked->unblock_time > Carbon::now())
				{
					return response()->json('You cannot vote yet. You can vote again in '.$siteBlocked->unblock_time, 403);
				}

				return response()->json(null, 200);
			}
			else
			{
				$clientIp = $request->ip();

				$voter = $this->vote->findLog($site->id, $request->user()->id);

				$request->session()->put('vsiteid', $site->id);
				$request->session()->put('vuserip', $clientIp);

				if ( ! $voter)
				{
					$vote = true;
				}
				else
				{
					if ($voter->unblock_time > Carbon::now())
					{
						return response()->json('You cannot vote yet. You can vote again in '.$voter->unblock_time, 403);
					}

					$vote = true;
				}

				return $vote ? response()->json($site->address, 200) : response()->json('Unable to vote, please try again later.', 403);
			}
		}

		return redirect()->action('VoteController@getIndex');
	}
}
