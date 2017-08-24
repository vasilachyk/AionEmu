<nav class="navbar navbar-default navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ action('Admin\DashboardController@getIndex') }}">AION ADMIN</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">

      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li><a href="{{ action('HomeController@index') }}">Site Index</a></li>

        @if (Auth::user()->access_level >= Settings::access()->ban)
          <li><a href="{{ action('Admin\BanController@getIndex') }}">Ban System</a></li>
        @endif

        @if (Auth::user()->access_level >= Settings::access()->news)
          <li><a href="{{ action('Admin\NewsController@index') }}">News</a></li>
        @endif

        @if (Auth::user()->access_level >= Settings::access()->news_category)
          <li><a href="{{ action('Admin\NewsCategoryController@index') }}">News Category</a></li>
        @endif

        @if (Auth::user()->access_level >= Settings::access()->accounts)
          <li><a href="{{ action('Admin\AccountController@index') }}">Accounts</a></li>
        @endif

        @if (Auth::user()->access_level >= Settings::access()->tools)
          <li><a href="{{ action('Admin\ToolsController@getIndex') }}">Tools</a></li>
        @endif

        @if (Auth::user()->access_level >= Settings::access()->membership)
          <li><a href="{{ action('Admin\MembershipController@getIndex') }}">Membership</a></li>
        @endif

        @if (Auth::user()->access_level >= Settings::access()->vote)
          <li><a href="{{ action('Admin\VoteController@index') }}">Vote</a></li>
        @endif

        @if (Auth::user()->access_level >= Settings::access()->webshop)
          <li><a href="{{ action('Admin\WebshopController@index') }}">Webshop</a></li>
        @endif

        @if (Auth::user()->access_level >= Settings::access()->webshop_category)
          <li><a href="{{ action('Admin\WebshopCategoryController@index') }}">Webshop Category</a></li>
        @endif

        @if (Auth::user()->access_level >= Settings::access()->pages)
          <li><a href="{{ action('Admin\PageController@index') }}">Pages</a></li>
        @endif

        @if (Auth::user()->access_level >= Settings::access()->logs)
          <li><a href="{{ action('Admin\LogController@getIndex') }}">Logs</a></li>
        @endif

        @if (Auth::user()->access_level >= Settings::access()->settings)
          <li><a href="{{ action('Admin\SettingsController@getIndex') }}">Settings</a></li>
        @endif

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Welcome, {{ Auth::user()->name }} <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{ action('Auth\AuthController@getLogout') }}">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>