<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ URL::asset('assets/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ URL::asset('assets/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ URL::asset('assets/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{ URL::asset('ico/apple-touch-icon-57-precomposed.png')}}">
    <link rel="shortcut icon" href="{{ URL::asset('assets/ico/favicon.png')}}">
    <title>@yield('title')</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ URL::asset('assets/bootstrap/css/bootstrap.css')}}" rel="stylesheet">


    <!-- styles needed by swiper slider -->
    <link href="{{ URL::asset('assets/plugins/swiper-master/css/swiper.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ URL::asset('assets/css/style.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/home-v7.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/cart-nav.css')}}" rel="stylesheet">


    <!-- Just for debugging purposes. -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- include pace script for automatic web page progress bar  -->

    <script>
        paceOptions = {
            elements: true
        };
    </script>
    <script src="{{ URL::asset('assets/js/pace.min.js')}}"></script>
</head>
<body>

@include('layouts.header')

@yield('content')

@include('layouts.footer')

        <!-- Le javascript
================================================== -->

<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="{{ URL::asset('assets/js/jquery/jquery-1.10.1.min.js')}}"></script>
<script src="{{ URL::asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/swiper-master/js/swiper.jquery.min.js')}}"></script>
<script>

    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        paginationClickable: '.swiper-pagination',
        nextButton: '.arrow-right',
        prevButton: '.arrow-left',
// effect: 'cube',
        keyboardControl: true,
        parallax: true,
        speed: 600,
        spaceBetween: 0,
        autoplay:3000
    });


</script>

<!-- include jqueryCycle plugin -->
<script src="{{ URL::asset('assets/js/jquery.cycle2.min.js')}}"></script>

<!-- include easing plugin -->
<script src="{{ URL::asset('assets/js/jquery.easing.1.3.js')}}"></script>

<!-- include  parallax plugin -->
<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.parallax-1.1.js')}}"></script>

<!-- optionally include helper plugins -->
<script type="text/javascript" src="{{ URL::asset('assets/js/helper-plugins/jquery.mousewheel.min.js')}}"></script>

<!-- include mCustomScrollbar plugin //Custom Scrollbar  -->

<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.mCustomScrollbar.js')}}"></script>

<!-- include icheck plugin // customized checkboxes and radio buttons   -->
<script type="text/javascript" src="{{ URL::asset('assets/plugins/icheck-1.x/icheck.min.js')}}"></script>

<!-- include grid.js // for equal Div height  -->
<script src="{{ URL::asset('assets/js/grids.js')}}"></script>

<!-- include carousel slider plugin  -->
<script src="{{ URL::asset('assets/js/owl.carousel.min.js')}}"></script>

<!-- jQuery select2 // custom select   -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

<!-- include touchspin.js // touch friendly input spinner component   -->
<script src="{{ URL::asset('assets/js/bootstrap.touchspin.js')}}"></script>

<!-- include custom script for only homepage  -->
<script src="{{ URL::asset('assets/js/home.js')}}"></script>

<!-- include custom script for site  -->
<script src="{{ URL::asset('assets/js/script.js')}}"></script>

<script src="{{ URL::asset('assets/js/sidebar-nav.js')}}"></script>


<!-- scrollme || onscroll parallax effect for category page  -->
<script src="{{ URL::asset('assets/js/jquery.scrollme.min.js')}}"></script>
<script src="{{ URL::asset('backend/plugins/jQuery/jquery.form.js')}}"></script>

<script type="text/javascript">


    $(function () {
        var target = $("div.has-overly-shade"),
                targetHeight = target.outerHeight();
        $(document).scroll(function () {
            var scrollPercent = (targetHeight - window.scrollY) / targetHeight;
            scrollPercent >= 0 && (target.css("background-color", "rgba(0,0,0," + (1.1 - scrollPercent) + ")"))
        })
    });


    $(function () {
        if (navigator.userAgent.match(/(iPod|iPhone|iPad|Android)/)) {
            $('#ios-notice').removeClass('hidden');
            $('.parallax-container').height($(window).height() * 0.5 | 0);
        } else {
            $(window).resize(function () {
                var parallaxHeight = Math.max($(window).height() * 0.7, 200) | 0;
                $('.parallax-container').height(parallaxHeight);
            }).trigger('resize');
        }
    });


    $(document).ready(function () {
        var isMobile = function () {
            //console.log("Navigator: " + navigator.userAgent);
            return /(iphone|ipod|ipad|android|blackberry|windows ce|palm|symbian)/i.test(navigator.userAgent);
        };

        if (isMobile()) {
            // For  mobile , ipad, tab
            $('.animateme').removeClass('animateme');
            $('.if-is-mobile').addClass('ismobile');

        } else {
        }


    }); // end




</script>

@yield('page-script')

@yield('login-script')

@yield('register-script')

</body>
</html>
