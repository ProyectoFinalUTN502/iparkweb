<!DOCTYPE HTML>
<html>
    <head>
        <title>iParking | Tu estacionamiento</title>

        <link href="public/landing/css/bootstrap.css" rel='stylesheet' type='text/css' />
        <script src="public/landing/js/jquery.min.js"></script>
        <script type="text/javascript" src="public/landing/js/move-top.js"></script>
        <script type="text/javascript" src="public/landing/js/easing.js"></script>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                $(".scroll").click(function (event) {
                    event.preventDefault();
                    $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1200);
                });
            });
        </script>
        <link href="public/landing/css/style.css" rel='stylesheet' type='text/css' />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    </script>

    <link href='http://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900' rel='stylesheet' type='text/css'>
    
    <link href="public/landing/css/owl.carousel.css" rel="stylesheet">
    <script src="public/landing/js/owl.carousel.js"></script>
    <script>
            $(document).ready(function () {
                $("#owl-demo , #owl-demo1").owlCarousel({
                    items: 1,
                    lazyLoad: true,
                    autoPlay: true
                });
            });
    </script>
    <script>
        $(document).ready(function () {
            $("#owl-demo3").owlCarousel({
                items: 4,
                lazyLoad: true,
                autoPlay: true,
                navigation: false,
                pagination: false
            });
        });
    </script>
    <!----- //End-Share-instantly-slider---->

    <!----start-top-nav-script---->
    <script>
        $(function () {
            var pull = $('#pull');
            menu = $('nav ul');
            menuHeight = menu.height();
            $(pull).on('click', function (e) {
                e.preventDefault();
                menu.slideToggle();
            });
            $(window).resize(function () {
                var w = $(window).width();
                if (w > 320 && menu.is(':hidden')) {
                    menu.removeAttr('style');
                }
            });
        });
    </script>
    <!----//End-top-nav-script---->
    <script src="public/landing/js/easyResponsiveTabs.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#horizontalTab').easyResponsiveTabs({
                type: 'default', //Types: default, vertical, accordion           
                width: 'auto', //auto or any width like 600px
                fit: true   // 100% fit in a container
            });
        });
    </script>
</head>

