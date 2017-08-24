<?php

namespace App\Http\Controllers\Admin;

use Settings;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\BanChar;
use App\Http\Requests\Admin\BanIp;
use App\Http\Requests\Admin\BanMac;
use App\Http\Controllers\Controller;
use App\Repositories\PlayerRepositoryInterface;
use App\Repositories\BanRepositoryInterface;

class BanController extends Controller
{
    protected $players;

    protected $ban;

    public function __construct(PlayerRepositoryInterface $players, BanRepositoryInterface $ban)
    {
        $this->middleware('auth.access:'.Settings::access()->ban);

        $this->players = $players;

        $this->ban = $ban;
    }

    public function getIndex()
    {
        return view('admin.ban.index');
    }

    public function getPlayer(Request $request)
    {
        if ($request->get('filterby'))
        {
            $players = $this->players->filterByBan($request->get('filterby'));
        }
        elseif ($request->get('name'))
        {
            $players = $this->players->filterByName($request->get('name'));
        }
        elseif ($request->get('account'))
        {
            $players = $this->players->filterByAccount($request->get('account'));
        }
        elseif ($request->get('playerid'))
        {
            $players = $this->players->filterByPlayerID($request->get('playerid'));
        }
        else
        {
            $players = $this->players->all();
        }

        $data = [
            'players' => $players
        ];

        return view('admin.ban.player', $data);
    }

    public function getCharEdit($id = null)
    {
        if ( ! is_numeric($id) || empty($id))
        {
            return redirect()->action('Admin\BanController@getPlayer')->with('failure', 'Unable to edit the selected player.');
        }

        $player = $this->players->find($id);

        if (empty($player))
        {
            return redirect()->action('Admin\BanController@getPlayer')->with('failure', 'Player not found.');
        }

        $data = [
            'player' => $player
        ];

        return view('admin.ban.player-edit', $data);
    }

    public function postChar($id, BanChar $request)
    {
        if ( ! is_numeric($id) || empty($id))
        {
            return redirect()->action('Admin\BanController@getPlayer')->with('failure', 'Unable to update the selected player.');
        }

        $player = $this->players->find($id);

        if (empty($player))
        {
            return redirect()->action('Admin\BanController@getPlayer')->with('failure', 'Player not found.');
        }

        $banExists = $this->ban->findChar($player->id);

        if ($banExists)
        {
            $banned = $this->ban->updateChar($player->id, $request->all());

            return $banned ? redirect()->action('Admin\BanController@getPlayer')->with('success', 'Player ' . $player->name . ' banned status has been updated.') : redirect()->action('Admin\BanController@getPlayer')->with('failure', 'Unable to ban ' . $player->name);
        }
        else
        {
            $banned = $this->ban->createChar($player->id, $request->all());

            return $banned ? redirect()->action('Admin\BanController@getPlayer')->with('success', 'Player ' . $player->name . ' has been banned.') : redirect()->action('Admin\BanController@getPlayer')->with('failure', 'Unable to ban ' . $player->name);
        }
    }

    public function postRemoveChar($id, Request $request)
    {
        if ( ! is_numeric($id) || empty($id))
        {
            return redirect()->action('Admin\BanController@getPlayer')->with('failure', 'Unable to lift ban.');
        }

        $player = $this->players->find($id);

        if (empty($player))
        {
            return redirect()->action('Admin\BanController@getPlayer')->with('failure', 'Player not found.');
        }

        $banExists = $this->ban->findChar($player->id);

        if ($banExists)
        {
            $this->ban->removeChar($banExists->player_id);

            return redirect()->action('Admin\BanController@getPlayer')->with('success', 'Player ' . $player->name . ' banned status has been lifted.');
        }
        else
        {
            return redirect()->action('Admin\BanController@getPlayer')->with('failure', 'This player is not banned.');
            // return response()->json(null, 404);
        }

        return redirect()->action('Admin\BanController@getPlayer');
    }

    public function getBannedIp(Request $request)
    {
        if ($request->get('ip'))
        {
            $ips = $this->ban->filterBannedIp($request->get('ip'));
        }
        else
        {
            $ips = $this->ban->getBannedIps();
        }

        $data = [
            'ips'   =>  $ips
        ];

        return view('admin.ban.ip', $data);
    }

    public function getIpEdit($id, Request $request)
    {
        if ( ! is_numeric($id) || empty($id))
        {
            return redirect()->action('Admin\BanController@getBannedIp')->with('failure', 'Unable to edit the selected ip.');
        }

        $ip = $this->ban->findIpById($id);

        if (empty($ip))
        {
            return redirect()->action('Admin\BanController@getBannedIp')->with('failure', 'Ip not found.');
        }

        $data = [
            'ip' => $ip
        ];

        return view('admin.ban.ip-edit', $data);
    }

    public function postIpEdit($id, BanIp $request)
    {
        if ( ! is_numeric($id) || empty($id))
        {
            return redirect()->action('Admin\BanController@getBannedIp')->with('failure', 'Unable to update the selected ip.');
        }

        $ip = $this->ban->findIpById($id);

        if (empty($ip))
        {
            return redirect()->action('Admin\BanController@getBannedIp')->with('failure', 'Ip not found.');
        }

        $banned = $this->ban->updateIpBan($ip->id, $request->all());

        return $banned ? redirect()->action('Admin\BanController@getBannedIp')->with('success', 'Ip ' . $ip->mask . ' banned status has been updated.') : redirect()->action('Admin\BanController@getBannedIp')->with('failure', 'Unable to update ip ' . $ip->mask);
    }

    public function postRemoveIp($id, Request $request)
    {
        if ( ! is_numeric($id) || empty($id))
        {
            return redirect()->action('Admin\BanController@getBannedIp')->with('failure', 'Unable to lift ban.');
        }

        $ip = $this->ban->findIpById($id);

        if (empty($ip))
        {
            return redirect()->action('Admin\BanController@getBannedIp')->with('failure', 'Ip not found.');
        }

        $banned = $this->ban->removeIpBan($ip->id);

        return $banned ? redirect()->action('Admin\BanController@getBannedIp')->with('success', 'Ip ' . $ip->mask . ' banned status has been lifted.') : redirect()->action('Admin\BanController@getBannedIp')->with('failure', 'Unable to lift ip ' . $ip->mask . ' banned status.');
    }

    public function getBannedMac(Request $request)
    {
        if ($request->get('mac'))
        {
            $macs = $this->ban->filterBannedMac($request->get('mac'));
        }
        else
        {
            $macs = $this->ban->getBannedMacs();
        }

        $data = [
            'macs'   =>  $macs
        ];

        return view('admin.ban.mac', $data);
    }

    public function postRemoveMac($id, Request $request)
    {
        if ( ! is_numeric($id) || empty($id))
        {
            return redirect()->action('Admin\BanController@getBannedMac')->with('failure', 'Unable to lift ban.');
        }

        $mac = $this->ban->findMacById($id);

        if (empty($mac))
        {
            return redirect()->action('Admin\BanController@getBannedMac')->with('failure', 'Mac not found.');
        }

        $banned = $this->ban->removeMacBan($mac->uniId);

        return $banned ? redirect()->action('Admin\BanController@getBannedMac')->with('success', 'Mac ' . $mac->address . ' banned status has been lifted.') : redirect()->action('Admin\BanController@getBannedMac')->with('failure', 'Unable to lift mac ' . $mac->address . ' banned status.');
    }
}
