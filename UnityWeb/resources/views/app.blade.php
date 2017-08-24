<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="Expo Aion 4.9, Aion Private Server 4.9, Aion Online">
    <meta name="author" content="">
    <meta name="theme-color" content="#141619">
    <title>Aion Unity Community</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="csrf-param" content="_token" />

    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">

    <!-- SET STYLE -->
    <link rel="stylesheet" href="{{ asset ('css/custom.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset ('css/theme.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset ('css/helpers.min.css') }}" rel="stylesheet" />
	<link rel="stylesheet" href="{{ asset ('css/news.min.css') }}" rel="stylesheet" />
	<link rel="stylesheet" href="{{ asset ('css/news.css') }}" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700' rel='stylesheet' type='text/css'>

    <!-- PLUGIN -->

    <link rel="stylesheet"  href="{{ asset ('plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet"  href="{{ asset ('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet"  href="{{ asset ('plugins/ionicons/css/ionicons.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet"  href="{{ asset ('plugins/animate/animate.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet"  href="{{ asset ('plugins/animate/animate.delay.css') }}" rel="stylesheet" />
    <link rel="stylesheet"  href="{{ asset ('plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />
</head>

<body class="fixed-header">

    @include('header.header')

    <div class="modal-search">
        <div class="container">
            <input type="text" class="form-control" placeholder="Type to search...">
            <i class="fa fa-times close"></i>
        </div>
    </div>

    <div id="wrapper">
        @yield('content')
    </div>

    <!-- FOOTER -->
    @include('footer.footer')
    <!-- JAVASCRIPT -->
    <script src="{{ asset('plugins/jquery/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/core.min.js') }}"></script>
    <script src="{{ asset('plugins/owl-carousel/owl.carousel.min.js') }}"></script>
    <script>
        (function($) {
            "use strict";
            var owl = $(".owl-carousel");

            owl.owlCarousel({
                items : 4, //4 items above 1000px browser width
                itemsDesktop : [1000,3], //3 items between 1000px and 0
                itemsTablet: [600,1], //1 items between 600 and 0
                itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option
            });

            $(".next").click(function(){
                owl.trigger('owl.next');
                return false;
            })
            $(".prev").click(function(){
                owl.trigger('owl.prev');
                return false;
            })
        })(jQuery);
    </script>
</body>

</html>