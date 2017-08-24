<header>
    <div class="container">
        <span class="bar hide"></span>
        <a href="{{ action('HomeController@index') }}" class="logo"><img src="{{ asset('images/logo.png') }}" alt=""></a>
        <nav>
            <div class="nav-control">
                <ul>
                    <li><a href="{{ action('HomeController@index') }}">Home</a></li>
                    <li><a href="{{ action('HomeController@download') }}">Download</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle">Store</a>
                        <ul class="dropdown-menu default">
                            <li><a href="{{ action('DonateListController@index') }}">Donate List</a></li>
                            <li><a href="{{ action('WebshopController@getIndex') }}">Webshop</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle">Ranking</a>
                        <ul class="dropdown-menu default">
                            <li><a href="{{ action('RankingController@getAbyss') }}" title="Players">Top Player</a></li>
                            <li><a href="{{ action('RankingController@getGp') }}" title="Glory Players">Top Glory Player</a></li>
                            <li><a href="{{ action('RankingController@getAp') }}" title="Abyss Players">Top Abyss Player</a></li>
                            <li><a href="{{ action('RankingController@getLegions') }}" title="Legions">Top Legion</a></li>
                        </ul>
                    </li>
                    <li><a href="https://forum.heat.web.id">Forum</a></li>
                </ul>
            </div>
        </nav>
        <div class="nav-right">
			<ul>
				<li><a class="stylesheet">Login : <span class="spanduk">{{ Status::loginServer('45.64.98.67', Settings::general()->port_game) }}<span></a></li>
				<li><a class="stylesheet">Game : <span class="spanduk">{{ Status::gameServer('45.64.98.67', Settings::general()->port_game) }}<span></a></li> 
				<li><a class="stylesheet">Online Players : <span class="spanduk">{{ Status::onlineCount() }}<span></a></li>
			</ul>
            @if (Auth::check())
                <div class="nav-profile dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span>{{ Auth::user()->name }}</span></a>
                    <ul class="dropdown-menu">
                        @if (Auth::user()->access_level >= 8)
                            <li><a href="{{ action('Admin\DashboardController@getIndex') }}"><i class="fa fa-user-md" style="color:white;"></i> Admin</a></li>
                        @endif
                        <li><a href="{{ action('AccountController@getIndex') }}"><i class="fa fa-user" style="color:white;"></i> My Account</a></li>
                        <li><a href="{{ action('VoteController@getIndex') }}"><i class="fa fa-gamepad" style="color:white;"></i> Vote</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ action('Auth\AuthController@getLogout') }}"><i class="fa fa-power-off" style="color:white;"></i> Sign Out</a></li>
                    </ul>
                </div>
                <a href="#" data-toggle="modal-search"><i class="fa fa-search"></i></a>
            @else
                <div class="nav-profile dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span>Menu Account</span></a>
					<ul class="dropdown-menu">
						<li><a href="{{ action('Auth\AuthController@getLogin') }}"><i class="fa fa-sign-in" style="color : white;"></i> Login</a></li>
						<li><a href="{{ action('Auth\AuthController@getRegister') }}"><i class="fa fa-group" style="color : white;"></i> Register</a></li>
					</ul>
				</div>
            @endif
        </div>
    </div>
	 <!--<iframe width="0" height="0" src="https://www.youtube.com/embed/s-jaOwPSef8?rel=0&autoplay=1" frameborder="0" allowfullscreen></iframe>-->
</header>