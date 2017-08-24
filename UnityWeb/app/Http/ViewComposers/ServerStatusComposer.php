<?php

namespace App\Http\ViewComposers;

use Request;
use Settings;
use Illuminate\Contracts\View\View;

class ServerStatusComposer {

	public function compose(View $view)
	{
		$server = Request::server()['SERVER_ADDR'];
		$portgame = Settings::general()->port_game;
		$portlogin = Settings::general()->port_login;
		$timeout = Settings::general()->port_timeout;

		$game = @fsockopen($server, $portgame, $errno, $errstr, $timeout);
		$login = @fsockopen($server, $portlogin, $errno, $errstr, $timeout);

		$view->with('game', $game);
		$view->with('login', $login);
	}
}