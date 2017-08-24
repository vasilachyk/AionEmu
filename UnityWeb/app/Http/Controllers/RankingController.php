<?php

namespace App\Http\Controllers;

use Settings;
use Illuminate\Http\Request;
use App\Repositories\RankingRepositoryInterface;

class RankingController extends Controller {

	protected $ranking;

	public function __construct(RankingRepositoryInterface $ranking)
	{
		$this->ranking = $ranking;
	}

	public function getIndex(Request $request)
	{
		if ($request->get('filterby'))
		{
			$filter = $request->get('filterby');

			if ($filter == 'ely')
			{
				$players = $this->ranking->getAPFilterBy(Settings::general()->rank_ap, $filter);
			}
			elseif ($filter == 'asmo')
			{
				$players = $this->ranking->getAPFilterBy(Settings::general()->rank_ap, $filter);
			}
			else
			{
				$players =  $this->ranking->getAP(Settings::general()->rank_ap);
			}
		}
		else
		{
			$players =  $this->ranking->getAP(Settings::general()->rank_ap);
		}

		$data = [
			'players' => $players
		];

		return view('pages.ranking.ap', $data);
	}

	public function getAbyss(Request $request)
	{
		if ($request->get('filterby'))
		{
			$filter = $request->get('filterby');

			if ($filter == 'ely')
			{
				$players = $this->ranking->getAbyssFilterBy(Settings::general()->rank_abyss, $filter);
			}
			elseif ($filter == 'asmo')
			{
				$players = $this->ranking->getAbyssFilterBy(Settings::general()->rank_abyss, $filter);
			}
			else
			{
				$players = $this->ranking->getAbyss(Settings::general()->rank_abyss);
			}
		}
		else
		{
			$players = $this->ranking->getAbyss(Settings::general()->rank_abyss);
		}

		$data = [
			'players' => $players
		];

		return view('pages.ranking.abyss', $data);
	}

	public function getExperience(Request $request)
	{
		if ($request->get('class'))
		{
			$players = $this->ranking->getPlayersByExp(Settings::general()->rank_exp, $request->get('class'));
		}
		else
		{
			$players = $this->ranking->getPlayersByExp(Settings::general()->rank_exp);
		}

		$data = [
			'players' => $players
		];

		return view('pages.ranking.exp', $data);
	}

	public function getLegions(Request $request)
	{
		if ($request->get('filterby'))
		{
			$filter = $request->get('filterby');

			if ($filter == 'ely')
			{
				$legions = $this->ranking->getLegionsFilterBy(Settings::general()->rank_legions, $filter);
			}
			elseif ($filter == 'asmo')
			{
				$legions = $this->ranking->getLegionsFilterBy(Settings::general()->rank_legions, $filter);
			}
			else
			{
				$legions = $this->ranking->getLegions(Settings::general()->rank_legions);
			}
		}
		else
		{
			$legions = $this->ranking->getLegions(Settings::general()->rank_legions);
		}

		$data = [
			'legions' => $legions
		];

		return view('pages.ranking.legions', $data);
	}

	public function getGp(Request $request)
	{
		if ($request->get('filterby'))
		{
			$filter = $request->get('filterby');

			if ($filter == 'ely')
			{
				$players = $this->ranking->getGPFilterBy(Settings::general()->rank_gp, $filter);
			}
			elseif ($filter == 'asmo')
			{
				$players = $this->ranking->getGPFilterBy(Settings::general()->rank_gp, $filter);
			}
			else
			{
				$players =  $this->ranking->getGP(Settings::general()->rank_gp);
			}
		}
		else
		{
			$players =  $this->ranking->getGP(Settings::general()->rank_gp);
		}

		$data = [
			'players' => $players
		];

		return view('pages.ranking.gp', $data);
	}

	public function getAp(Request $request)
	{
		if ($request->get('filterby'))
		{
			$filter = $request->get('filterby');

			if ($filter == 'ely')
			{
				$players = $this->ranking->getAPFilterBy(Settings::general()->rank_ap, $filter);
			}
			elseif ($filter == 'asmo')
			{
				$players = $this->ranking->getAPFilterBy(Settings::general()->rank_ap, $filter);
			}
			else
			{
				$players =  $this->ranking->getAP(Settings::general()->rank_ap);
			}
		}
		else
		{
			$players =  $this->ranking->getAP(Settings::general()->rank_ap);
		}

		$data = [
			'players' => $players
		];

		return view('pages.ranking.ap', $data);
	}

	public function getKinah(Request $request)
	{
		if ($request->get('filterby'))
		{
			$filter = $request->get('filterby');

			if ($filter == 'ely')
			{
				$players = $this->ranking->getKinahFilterBy(Settings::general()->rank_kinah, $filter);
			}
			elseif ($filter == 'asmo')
			{
				$players = $this->ranking->getKinahFilterBy(Settings::general()->rank_kinah, $filter);
			}
			else
			{
				$players = $this->ranking->getKinah(Settings::general()->rank_kinah);
			}
		}
		else
		{
			$players = $this->ranking->getKinah(Settings::general()->rank_kinah);
		}

		$data = [
			'players' => $players
		];

		return view('pages.ranking.kinah', $data);
	}
}
