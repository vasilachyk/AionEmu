<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>{{ Settings::general()->server_name }}</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="csrf-param" content="_token" />

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->

        <link rel="stylesheet" href="{{ asset('css/bootstrap-custom.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
        <script src="{{ asset('js/vendor/modernizr-2.8.3.min.js') }}"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="container set-top">
            <div class="row">
                <div class="col-sm-12 col-md-3">
                    @include('navigation.main')
                </div>

                <div class="col-sm-12 col-md-9">

                    @if (Auth::check())
                        <div class="well well-sm">
                           Welcome, {{ Auth::user()->name }}

                            <a class="btn btn-danger btn-xs pull-right" href="{{ action('Auth\AuthController@getLogout') }}">Logout</a>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>

        </div>

        <script src="{{ asset('js/vendor/jquery-1.11.3.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/vendor/jquery-ujs.js') }}"></script>
        <script src="{{ asset('js/plugins.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
    </body>
</html>
