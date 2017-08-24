<footer>
    <div class="container">
        <div class="widget row">
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                <h4 class="title">About Heat Aion</h4>
                <p>Heat-Aion is a brand new private server since October 2016 located in Indonesian ready to explore and provide a better gameplay experience for you!.</p>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <h4 class="title">Categories</h4>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <ul class="nav">
                            <li><a href="{{ action('HomeController@index') }}">HOME</a></li>
                            <li><a href="#">STATS</a></li>
                            <li><a href="{{ action('WebshopController@getIndex') }}">STORE</a></li>
                            <li><a href="{{ action('HomeController@download') }}">DOWNLOAD</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <ul class="nav">
                            <li><a href="{{ action('RankingController@getAbyss') }}">TOP PLAYER</a></li>
                            <li><a href="{{ action('RankingController@getLegions') }}">TOP LEGIUN</a></li>
                            <li><a href="{{ action('RankingController@getAp') }}">TOP ABYSS POINT</a></li>
                            <li><a href="{{ action('RankingController@getGp') }}">TOP GLORY POINT</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <h4 class="title">Email Newsletters</h4>
                <p>Subscribe to our newsletter and get notification when new update are available.</p>
                <form method="post" class="btn-inline form-inverse">
                    <input type="text" class="form-control" placeholder="Email..." />
                    <button type="submit" class="btn btn-link"><i class="fa fa-envelope"></i></button>
                </form>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <ul class="list-inline">
                <!--<li><a href="#" class="btn btn-circle btn-social-icon" data-toggle="tooltip" title="Follow us on Twitter"><i class="fa fa-twitter"></i></a></li>-->
                <li><a href="https://www.facebook.com/groups/heat.aion/" class="btn btn-social-icon" data-toggle="tooltip" title="Follow us on Facebook"><i class="fa fa-facebook"></i></a></li>
                <!--<li><a href="#" class="btn btn-circle btn-social-icon" data-toggle="tooltip" title="Follow us on Google"><i class="fa fa-google-plus"></i></a></li>
                <li><a href="#" class="btn btn-circle btn-social-icon" data-toggle="tooltip" title="Follow us on Steam"><i class="fa fa-steam"></i></a></li> -->
            </ul>
        </div>
		 &copy; 2016 HEAT Aion. All rights reserved. <br/>
        <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5820142f277fb7280db9975d/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
    </div>
</footer>
<!--<iframe height="0" width="0" border="0" border="none" hidden src="../bg/themejikjowbbds.mp3?autoplay=1" style="visibility: hidden;"></iframe>-->