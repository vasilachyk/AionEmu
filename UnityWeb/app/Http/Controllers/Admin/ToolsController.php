<?php

namespace App\Http\Controllers\Admin;

use Settings;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Player;
use App\Http\Requests\Admin\ToolsSendRequest;
use App\Http\Controllers\Controller;
use App\Repositories\MailRepositoryInterface;
use App\Repositories\PlayerRepositoryInterface;
use App\Repositories\InventoryRepositoryInterface;
use App\Repositories\LogRepositoryInterface;

class ToolsController extends Controller
{
    protected $player;

    protected $mail;

    protected $log;

    protected $inventory;

    public function __construct(PlayerRepositoryInterface $player, MailRepositoryInterface $mail, LogRepositoryInterface $log, InventoryRepositoryInterface $inventory)
    {
        $this->middleware('auth.access:'.Settings::access()->tools);

        $this->player = $player;

        $this->mail = $mail;

        $this->log = $log;

        $this->inventory = $inventory;
    }

    public function getIndex()
    {
        return view('admin.tools.index');
    }

    public function getSendItem()
    {
        return view('admin.tools.senditem');
    }

    public function postSendItem(ToolsSendRequest $request)
    {
        $player = $this->player->findByName($request->get('player'));

        if (empty($player))
        {
            return redirect()->action('Admin\ToolsController@getSendItem')->with('failure', 'Selected player not found.');
        }

        $mail = $this->mail->toolsCreate($request->all(), $player);

        if ($mail)
        {
            $this->log->logToolsSendItem($request->all(), $player->id);

            return redirect()->action('Admin\ToolsController@getSendItem')->with('success', 'Item(s) has been mailed to Player ' . $player->name);
        }
        else
        {
            return redirect()->action('Admin\ToolsController@getSendItem')->with('failure', 'Unable to mail item to Player '. $player->name);
        }
    }

    public function getInventory()
    {
        return view('admin.tools.player');
    }

    public function postPlayerInventory(Player $request)
    {
        $player = $this->player->findByName($request->get('player'));

        if (empty($player))
        {
            return redirect()->action('Admin\ToolsController@getInventory')->with('failure', 'Player not found.');
        }

        if ($request->get('itemid'))
        {
            $inventory = $this->inventory->findPlayerItemByItemId($request->get('itemid'), $player->id);
        }
        else
        {
            $inventory = $this->inventory->getPlayerInventory($player->id, $player->account_id);
        }

        $data = [
            'player'    =>  $player,
            'inventory' =>  $inventory
        ];

        return view('admin.tools.inventory', $data);
    }

    public function postPlayerInventoryDelete($itemUniqueId, $player)
    {
        if ( ! is_numeric($itemUniqueId) || empty($itemUniqueId))
        {
            return redirect()->action('Admin\ToolsController@getInventory')->with('failure', 'Item id is missing.');
        }

        if (empty($player))
        {
            return redirect()->action('Admin\ToolsController@getInventory')->with('failure', 'Invalid player.');
        }

        $player = $this->player->findByName($player);

        if (empty($player))
        {
            return redirect()->action('Admin\ToolsController@getInventory')->with('failure', 'Player not found.');
        }

        if ($player->online)
        {
            return redirect()->action('Admin\ToolsController@getInventory')->with('failure', 'Unable to proceed, the player is online.');
        }

        $itemid = $this->inventory->findPlayerItemByItemUniqueId($itemUniqueId, $player->id);

        if (empty($itemid))
        {
            return redirect()->action('Admin\ToolsController@getInventory')->with('failure', 'Item not found in players inventory.');
        }

        $delete = $this->inventory->deleteItem($itemid->item_unique_id, $player->id);

        return $delete ? redirect()->action('Admin\ToolsController@getInventory')->with('success', 'Player ' . $player->name . ' item# '. $itemid->item_id . ' has been deleted.') : redirect()->action('Admin\ToolsController@getInventory')->with('failure', 'Unable to delete Player ' . $player->name . ' item# '. $itemid->item_id . ' item.');
    }

    public function postPlayerInventoryDeleteAll($player)
    {
        if (empty($player))
        {
            return redirect()->action('Admin\ToolsController@getInventory')->with('failure', 'Invalid player.');
        }

        $player = $this->player->findByName($player);

        if (empty($player))
        {
            return redirect()->action('Admin\ToolsController@getInventory')->with('failure', 'Player not found.');
        }

        if ($player->online)
        {
            return redirect()->action('Admin\ToolsController@getInventory')->with('failure', 'Unable to proceed, the player is online.');
        }

        $delete = $this->inventory->deleteAllItems($player->id);

        return $delete ? redirect()->action('Admin\ToolsController@getInventory')->with('success', 'Player ' . $player->name . ' items has been deleted.') : redirect()->action('Admin\ToolsController@getInventory')->with('failure', 'Unable to delete Player ' . $player->name . ' items.');
    }
}
