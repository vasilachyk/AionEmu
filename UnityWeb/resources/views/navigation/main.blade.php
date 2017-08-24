<div class="btn-group-vertical btn-block" role="group" aria-label="...">
   <a class="btn btn-default" href="{{ action('HomeController@index') }}">Home</a>
    @if (Auth::check())
      @if (Auth::user()->access_level >= Settings::access()->dashboard)
       <a class="btn btn-default" href="{{ action('Admin\DashboardController@getIndex') }}">Admin Dashboard</a>
      @endif
      <a class="btn btn-default" href="{{ action('AccountController@getIndex') }}">My Account</a>
    @else
     <a class="btn btn-default" href="{{ action('Auth\AuthController@getRegister') }}">Register</a>
     <a class="btn btn-default" href="{{ action('Auth\AuthController@getLogin') }}">Login</a>
    @endif
   <a class="btn btn-default" href="{{ action('HomeController@onlinePlayers') }}">Online Players</a>
   <a class="btn btn-default" href="{{ action('RankingController@getIndex') }}">Ranking</a>
   <a class="btn btn-default" href="{{ action('VoteController@getIndex') }}">Vote</a>
   <a class="btn btn-default" href="{{ action('WebshopController@getIndex') }}">Webshop</a>
   <a class="btn btn-default" href="{{ action('DonateController@getIndex') }}">Donate</a>
   <a class="btn btn-default" href="{{ action('HomeController@staff') }}">Staff</a>
   <a class="btn btn-default" href="{{ action('HomeController@info') }}">Information</a>
   <a class="btn btn-default" href="{{ action('HomeController@download') }}">Download</a>

   @if ( ! $dbPages->isEmpty())
    @foreach ($dbPages as $page)
      <a class="btn btn-default" href="{{ action('PageController@getPage', $page->slug) }}">{{ ucfirst($page->title) }}</a>
    @endforeach
   @endif
</div>