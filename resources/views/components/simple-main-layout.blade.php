<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title> Monica Finance - Epargnez autrement </title>

    <meta name="description" content="">
    <meta name="author" content="monicafinance">
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    <meta name="googlebot-news" content="noindex">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- favicons Icons -->
    <link rel="apple-touch-icon" sizes="" href="{{ asset('media/gmedia/favicons/apple-touch-icon.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('media/gmedia/favicons/favicon-32x32.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('media/gmedia/favicons/favicon-16x16.png') }}" />
    <link rel="manifest" href="{{ asset('media/gmedia/favicons/site.webmanifest') }}" />
    <meta name="description" content="Monicafinance - Investissement et finances " />

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('media/gmedia/vendors/bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('media/gmedia/vendors/animate/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('media/gmedia/vendors/animate/custom-animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('media/gmedia/vendors/fontawesome/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('media/gmedia/vendors/jarallax/jarallax.css') }}" />
    <link rel="stylesheet" href="{{ asset('media/gmedia/vendors/jquery-magnific-popup/jquery.magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('media/gmedia/vendors/nouislider/nouislider.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('media/gmedia/vendors/nouislider/nouislider.pips.css') }}" />
    <link rel="stylesheet" href="{{ asset('media/gmedia/vendors/odometer/odometer.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('media/gmedia/vendors/swiper/swiper.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('media/gmedia/vendors/qrowd-icons/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('media/gmedia/vendors/tiny-slider/tiny-slider.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('media/gmedia/vendors/reey-font/stylesheet.css') }}" />
    <link rel="stylesheet" href="{{ asset('media/gmedia/vendors/owl-carousel/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('media/gmedia/vendors/owl-carousel/owl.theme.default.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('media/gmedia/vendors/bxslider/jquery.bxslider.css') }}" />
    <link rel="stylesheet" href="{{ asset('media/gmedia/vendors/bootstrap-select/css/bootstrap-select.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('media/gmedia/vendors/vegas/vegas.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('media/gmedia/vendors/jquery-ui/jquery-ui.css') }}" />
    <link rel="stylesheet" href="{{ asset('media/gmedia/vendors/timepicker/timePicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('media/gmedia/vendors/nice-select/nice-select.css') }}" />


    <!-- template styles -->
    @vite(['resources/gassets/css/qrowd.css', 'resources/gassets/css/qrowd-responsive.css'])


</head>

<body class="custom-cursor">

    <div class="preloader">
        <div class="preloader__image"></div>
    </div>
    <!-- /.preloader -->

    <div class="page-wrapper">
        {{ $slot }}
    </div>

    <script type="application/javascript" src="{{ asset('media/gmedia/vendors/jquery/jquery-3.6.0.min.js') }}"></script>
    <script type="application/javascript" src="{{ asset('media/gmedia/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script type="application/javascript" src="{{ asset('media/gmedia/vendors/jarallax/jarallax.min.js') }}"></script>
    <script type="application/javascript" src="{{ asset('media/gmedia/vendors/jquery-ajaxchimp/jquery.ajaxchimp.min.js') }}"></script>
    <script type="application/javascript" src="{{ asset('media/gmedia/vendors/jquery-appear/jquery.appear.min.js') }}"></script>
    <script type="application/javascript" src="{{ asset('media/gmedia/vendors/jquery-circle-progress/jquery.circle-progress.min.js') }}"></script>
    <script type="application/javascript" src="{{ asset('media/gmedia/vendors/jquery-magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script type="application/javascript" src="{{ asset('media/gmedia/vendors/jquery-validate/jquery.validate.min.js') }}"></script>
    <script type="application/javascript" src="{{ asset('media/gmedia/vendors/nouislider/nouislider.min.js') }}"></script>
    <script type="application/javascript" src="{{ asset('media/gmedia/vendors/odometer/odometer.min.js') }}"></script>
    <script type="application/javascript" src="{{ asset('media/gmedia/vendors/swiper/swiper.min.js') }}"></script>
    <script type="application/javascript" src="{{ asset('media/gmedia/vendors/tiny-slider/tiny-slider.min.js') }}"></script>
    <script type="application/javascript" src="{{ asset('media/gmedia/vendors/wnumb/wNumb.min.js') }}"></script>
    <script type="application/javascript" src="{{ asset('media/gmedia/vendors/wow/wow.js') }}"></script>
    <script type="application/javascript" src="{{ asset('media/gmedia/vendors/isotope/isotope.js') }}"></script>
    <script type="application/javascript" src="{{ asset('media/gmedia/vendors/countdown/countdown.min.js') }}"></script>
    <script type="application/javascript" src="{{ asset('media/gmedia/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
    <script type="application/javascript" src="{{ asset('media/gmedia/vendors/bxslider/jquery.bxslider.min.js') }}"></script>
    <script type="application/javascript" src="{{ asset('media/gmedia/vendors/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
    <script type="application/javascript" src="{{ asset('media/gmedia/vendors/vegas/vegas.min.js') }}"></script>
    <script type="application/javascript" src="{{ asset('media/gmedia/vendors/jquery-ui/jquery-ui.js') }}"></script>
    <script type="application/javascript" src="{{ asset('media/gmedia/vendors/timepicker/timePicker.js') }}"></script>
    <script type="application/javascript" src="{{ asset('media/gmedia/vendors/circleType/jquery.circleType.js') }}"></script>
    <script type="application/javascript" src="{{ asset('media/gmedia/vendors/circleType/jquery.lettering.min.js') }}"></script>
    <script type="application/javascript" src="{{ asset('media/gmedia/vendors/nice-select/jquery.nice-select.min.js') }}"></script>

    <!-- template js -->
    @vite(['resources/gassets/js/qrowd.js']);
</body>

</html>