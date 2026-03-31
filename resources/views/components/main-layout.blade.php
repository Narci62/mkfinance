<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title> Monica Finance - {{ __('Epargnez autrement') }} </title>

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

        <!-- <div class="custom-cursor__cursor"></div>
        <div class="custom-cursor__cursor-two"></div> -->
        <!-- /.cursor -->


        <div class="preloader">
            <div class="preloader__image"></div>
        </div>
        <!-- /.preloader -->

        <div class="page-wrapper">
            <header class="main-header">
                <div class="main-header__top">
                    <div class="main-header__top-inner">
                        <div class="main-header__top-left">
                            <ul class="list-unstyled main-header__contact-list">
                                <li>
                                    <div class="icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="text">
                                        <p>{{ __('Bénin, cotonou') }}</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="text">
                                        <p><a href="mailto:info@monicafinance.com">info@monicafinance.com</a></p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="main-header__top-right">
                            <div class="main-header__login">
                                @if(Auth::check())
                                    @if(Auth::user()->account_type == "company")
                                        <ul class="list-unstyled main-header__login-list">
                                            <li><a href="{{ route('co') }}"> <i class="icon-account"></i> {{ __('Mon compte') }}</a></li>
                                            <li>
                                                <form action="{{ route('logout') }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm">
                                                        <i class="fa fa-fw fa-arrow-alt-circle-left me-1"></i> {{ __('Déconnexion') }}
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    @else
                                        <ul class="list-unstyled main-header__login-list">
                                            <li><a href="{{ route('in') }}"> <i class="icon-account"></i> {{ __('Mon compte') }}</a></li>
                                            <form action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm">
                                                    <i class="fa fa-fw fa-arrow-alt-circle-left me-1"></i> {{ __('Déconnexion') }}
                                                </button>
                                            </form>
                                        </ul>
                                    @endif
                                @else
                                    <ul class="list-unstyled main-header__login-list">
                                        <li><a href="{{ route('login') }}"> <i class="icon-account"></i> {{ __('Connexion') }}</a></li>
                                        <li><a href="{{ route('register') }}">{{ __('Créer un compte') }}</a></li>
                                    </ul>
                                @endif
                            </div>
                            <div class="main-header__social">
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-facebook"></i></a>
                            </div>
                        </div>
                    </div> 
                </div>
                <nav class="main-menu">
                    <div class="main-menu__wrapper">
                        <div class="main-menu__wrapper-inner clearfix">
                            <div class="main-menu__left">
                                <div class="main-menu__logo">
                                    <a href="{{ route('home') }}"><img src="{{ asset('media/gmedia/resources/logo-1.png') }}" alt=""></a>
                                </div>
                                <div class="main-menu__main-menu-box">
                                    <a href="#" class="mobile-nav__toggler"><i class="fa fa-bars"></i></a>
                                    <ul class="main-menu__list">
                                        <li class="dropdown">
                                            <a href="{{ route('howToInvest') }}">{{ __('Investissement') }} </a>
                                            <ul class="shadow-box">
                                                <li><a href="{{ route('howToInvest') }}">{{ _('Comment investir ?') }}</a></li>
                                                <li><a href="{{ route('whyInvest') }}">{{ _('Pourquoi investir ?') }}</a></li>
                                                <li><a href="{{ route('juridique') }}">{{ __('Avertissements et risques') }}</a></li>
                                                <li><a href="{{ route('faqs') }}">{{ __('Besoin d\'aide ?') }}</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a href="rise-funds.php">{{ _('Porteurs de projets') }}</a>
                                            <ul class="shadow-box">
                                                <li><a href="rise-funds.php">{{ __('Lever des fonds') }}</a></li>
                                                <li><a href="partener.php">{{ __('Devenez apporteur d\'affaires') }}</a></li>
                                                <li><a href="agent.php">{{ _('Devenez agent') }}</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a href="{{ route('mission') }}">{{ __('A propos') }}</a>
                                            <ul class="shadow-box">
                                                <li><a href="{{ route('mission') }}">{{ __('Notre mission') }}</a></li>
                                                <li><a href="{{ route('blog') }}">Notre blog</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="{{ route('contact') }}">{{ __('Nous contacter') }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="main-menu__right">
                                <div class="main-menu__call-search-btn-box">
                                    <div class="main-menu__call">
                                        <div class="main-menu__call-icon">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                        <div class="main-menu__call-content">
                                            <p class="main-menu__call-sub-title">{{ __('Nous appeler') }}</p>
                                            <h5 class="main-menu__call-number"><a href="tel:9200006780">+92 ( 8800 ) -
                                                    6780</a></h5>
                                        </div>
                                    </div>
                                    <div class="main-menu__btn-box">
                                        @auth
                                        <a href="{{ Auth::user()->account_type == 'company' ? route('co') : route('in') }}" class="thm-btn main-menu__btn"><i
                                                class="icon-plus-symbol"></i>{{ __('Tableau de bord') }}</a>
                                        @endauth
                                        @guest 
                                        <a href="{{route('register')}}" class="thm-btn main-menu__btn"><i
                                                class="icon-plus-symbol"></i>{{ __('Nous rejoindre') }}</a>
                                        @endguest
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>

            <div class="stricky-header stricked-menu main-menu">
                <div class="sticky-header__content"></div><!-- /.sticky-header__content -->
            </div><!-- /.stricky-header -->

            {{ $slot }}

            <!--Site Footer Start-->
            <footer class="site-footer">
                <div class="site-footer__top">
                    <div class="site-footer__shape-1 float-bob-x">
                        <img src="{{ asset('media/gmedia/shapes/site-footer-shape-1.png') }}" alt="">
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="100ms">
                                <div class="footer-widget__column footer-widget__about">
                                    <div class="footer-widget__logo">
                                        <a href="{{ route('home') }}"><img src="{{ asset('media/gmedia/resources/footer-logo.png') }} " alt=""></a>
                                    </div>
                                    <div class="footer-widget__about-text-box">
                                        <p class="footer-widget__about-text"> {{ __('MonicaFinance : Explorez le potentiel illimité des actions à forte rentabilité pour votre avenir financier!') }} </p>
                                    </div>
                                    <form class="footer-widget__subscribe-box">
                                        <div class="footer-widget__subscribe-input-box">
                                            <input type="email" placeholder="Adresse email" name="email">
                                            <button type="submit" class="footer-widget__subscribe-btn"><img
                                                    src="{{ asset('media/gmedia/icon/paper-plan.png') }}" alt=""></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="200ms">
                                <div class="footer-widget__column footer-widget__Explore">
                                    <div class="footer-widget__title-box">
                                        <h3 class="footer-widget__title">{{ _('Explorez') }}</h3>
                                    </div>
                                    <ul class="footer-widget__Explore-list list-unstyled">
                                        <li><a href="{{ route('howToInvest') }}">{{ _('Comment investir ?') }}</a></li>
                                        <li><a href="{{ route('whyInvest') }}">{{ __('Pourquoi investir ?') }}</a></li>
                                        <li><a href="{{ route('contact') }}">{{ __('Nous appeler') }}</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="300ms">
                                <div class="footer-widget__column footer-widget__Fundraising">
                                    <div class="footer-widget__title-box">
                                        <h3 class="footer-widget__title">{{ __('Investissement') }}</h3>
                                    </div>
                                    <ul class="footer-widget__Explore-list list-unstyled">
                                        <li><a href="#">{{ __('Immobilier') }}</a></li>
                                        <li><a href="#">{{ __('Energie') }}</a></li>
                                        <li><a href="#">{{ __('Technologie') }}</a></li>
                                        <li><a href="#">{{ __('Santé') }}</a></li>
                                        <li><a href="#">{{  _('Alimentation') }}</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="400ms">
                                <div class="footer-widget__column footer-widget__Contact">
                                    <div class="footer-widget__title-box">
                                        <h3 class="footer-widget__title">{{ __('Contacts') }}</h3>
                                    </div>
                                    <ul class="footer-widget__Contact-list list-unstyled">
                                        <li>
                                            <div class="icon">
                                                <span class="icon-telephone"></span>
                                            </div>
                                            <div class="text">
                                                <p><a href="tel:+000 00000">+92 ( 0000 ) - 0000</a></p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <span class="icon-email"></span>
                                            </div>
                                            <div class="text">
                                                <p><a href="mailto:info@monicafinance.com">info@monicafinance.com</a></p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <span class="icon-pin"></span>
                                            </div>
                                            <div class="text">
                                                <p>{{ __('Bénin, Cotonou') }}</p>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="site-footer__social">
                                        <a href="#"><i class="fab fa-facebook"></i></a>
                                        <a href="#"><i class="fab fa-twitter"></i></a>
                                        <a href="#"><i class="fab fa-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="site-footer__bottom">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="site-footer__bottom-inner">
                                    <p class="site-footer__bottom-text">© Copyright 2023 <a href="https://monicafinance.com/">MonicaFinance</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!--Site Footer End-->

        </div><!-- /.page-wrapper -->

        <div class="mobile-nav__wrapper">
            <div class="mobile-nav__overlay mobile-nav__toggler"></div>
            <!-- /.mobile-nav__overlay -->
            <div class="mobile-nav__content">
                <span class="mobile-nav__close mobile-nav__toggler"><i class="fa fa-times"></i></span>

                <div class="logo-box">
                    <a href="{{ route('home') }}" aria-label="logo image"><img src="{{ asset('media/gmedia/resources/logo-2.png') }}" width="143"
                            alt="" /></a>
                </div>
                <!-- /.logo-box -->
                <div class="mobile-nav__container"></div>
                <!-- /.mobile-nav__container -->

                <ul class="mobile-nav__contact list-unstyled">
                    <li>
                        <a style="width: 100%; text-align: center;" class="thm-btn main-menu__btn" href="new-project.php">{{ __('CONNEXION') }}</a>
                    </li>
                    <li style="border-bottom: 1px solid rgba(255, 255, 255, 0.1); padding-bottom: 10px;">
                        <a style="width: 100%; text-align: center;" href="">{{ __('Créer un compte') }}</a>
                    </li>
                    <li>
                        <i class="fa fa-envelope"></i>
                        <a href="mailto:needhelp@packa  geName__.com">info@monicafiance.com</a>
                        <hr style="border: 2px solid #FFF;">
                    </li>
                    <li>
                        <i class="fa fa-phone-alt"></i>
                        <a href="tel:666-888-0000">666 888 0000</a>
                    </li>
                </ul><!-- /.mobile-nav__contact -->
                <div class="mobile-nav__top">
                    <div class="mobile-nav__social">
                        <a href="#" class="fab fa-twitter"></a>
                        <a href="#" class="fab fa-facebook-square"></a>
                        <a href="#" class="fab fa-pinterest-p"></a>
                        <a href="#" class="fab fa-instagram"></a>
                    </div><!-- /.mobile-nav__social -->
                </div><!-- /.mobile-nav__top -->



            </div>
            <!-- /.mobile-nav__content -->
        </div>
        <!-- /.mobile-nav__wrapper -->

        <a href="#" data-target="html" class="scroll-to-target scroll-to-top"><i class="icon-right-arrow"></i></a>


        <script type="application/javascript" src="{{ asset('media/gmedia/vendors/jquery/jquery-3.6.0.min.js') }}"></script>
        <script type="application/javascript" src="{{ asset('media/gmedia/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script type="application/javascript" src="{{ asset('media/gmedia/vendors/jarallax/jarallax.min.js') }}"></script>
        <script type="application/javascript" src="{{ asset('media/gmedia/vendors/jquery-ajaxchimp/jquery.ajaxchimp.min.js') }}"></script>
        <script type="application/javascript" src="{{ asset('media/gmedia/vendors/jquery-appear/jquery.appear.min.js') }}"></script>
        <script type="application/javascript" src="{{ asset('media/gmedia/vendors/jquery-circle-progress/jquery.circle-progress.min.js') }}"></script>
        <script type="application/javascript" src="{{ asset('media/gmedia/vendors/jquery-magnific-popup/jquery.magnific-popup.min.js') }}"></script>
        <script type="application/javascript" src="{{ asset('media/gmedia/vendors/jquery-validate/jquery.validate.min.js') }}" ></script>
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