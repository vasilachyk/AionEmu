<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Aion Admin</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="csrf-param" content="_token" />

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->

        <link rel="stylesheet" type="text/css" href="{{ asset ('plugins/font-awesome/css/font-awesome.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset ('plugins/bootstrap/css/bootstrap.min.css') }}" />

        <link rel="stylesheet" href="{{ asset('plugins/bootstrap-datepicker.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ asset('js/vendor/modernizr-2.8.3.min.js') }}"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        @include('navigation.admin')

        <div class="container">
            <div class="row">
                @yield('content')
            </div>
        </div>


        <script src="{{ asset('js/vendor/jquery-1.11.3.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/vendor/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('js/vendor/speakingurl.min.js') }}"></script>
        <script src="{{ asset('js/vendor/slugify.min.js') }}"></script>
        <script src="{{ asset('js/vendor/jquery-ujs.js') }}"></script>
        <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
        <script src="{{ asset('js/plugins.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>