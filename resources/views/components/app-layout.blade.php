<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>Monica Finance - {{ __('Investissement &amp; Finances') }}</title>

    <meta name="description" content="">
    <meta name="author" content="monicafinance">
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    <meta name="googlebot-news" content="noindex">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Icons -->
    <link rel="shortcut icon" href="{{ asset('media/favicons/favicon.png') }}">
    <link rel="shortcut icon" sizes="32x32" href="{{ asset('media/favicons/favicon-32x32.png') }}">
    <link rel="shortcut icon" sizes="16x16" href="{{ asset('media/favicons/favicon-16x16.png') }}">
    <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/favicons/android-chrome-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="" href="{{ asset('media/favicons/apple-touch-icon.png') }}">

    <!-- Modules -->
    
    @vite(['resources/sass/main.scss', 'resources/js/dashmix/app.js'])
    <x-head.tinymce-config/>
    @yield('css')
    <!-- Alternatively, you can also include a specific color theme after the main stylesheet to alter the default color theme of the template -->
    {{-- @vite(['resources/sass/main.scss', 'resources/sass/dashmix/themes/xwork.scss', 'resources/js/dashmix/app.js']) --}}
    @yield('js')

    
</head>

<body>
    <div id="page-container" class="sidebar-o sidebar-dark side-scroll page-header-fixed main-content-boxed">

        @switch(Auth::user()->account_type)
        @case('admin')
        <x-admin-menu />
        @break

        @case('investor')
        <x-investor-menu />
        @break

        @case('company')
        <x-company-menu />
        @break

        @case('company')
        <x-admin-menu />
        @break

        @default
        <x-simple-menu />
        @endswitch

        <header id="page-header">
            <div class="content-header">
                <div class="space-x-1">
                    @if(url()->previous() && url()->previous() !== url()->current())
                    <a class="btn btn-alt-secondary" href="{{ url()->previous() }}">
                        <i class="fa fa-fw fa-arrow-left"></i>
                    </a>
                    @endif

                    <button type="button" class="btn btn-alt-secondary" data-toggle="layout" data-action="sidebar_toggle">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>

                    {{-- <button type="button" class="btn btn-alt-secondary" data-toggle="layout" data-action="header_search_on">
                            <i class="fa fa-fw opacity-50 fa-search"></i> <span class="ms-1 d-none d-sm-inline-block">Rechercher</span>
                        </button> --}}
                </div>

                <div class="space-x-1">
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn btn-alt-secondary" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="far fa-fw fa-circle-user"></i>
                            <span class="d-none d-sm-inline-block">{{ Auth::user()->firstname }}</span>
                            <i class="fa fa-fw fa-angle-down opacity-50 ms-1 d-none d-sm-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end p-0" aria-labelledby="page-header-user-dropdown">
                            <div class="bg-primary-dark rounded-top fw-semibold text-white text-center p-3">
                                @if(Auth::user()->avatar)
                                <img class="img-avatar img-avatar img-avatar-thumb" src="{{ Storage::url(auth()->user()->avatar) }}" alt="">
                                @else
                                <img class="img-avatar img-avatar img-avatar-thumb" src="{{ asset('media/avatars/avatar8.jpg') }}" alt="">
                                @endif
                                <div class="pt-2">
                                    <a class="text-white fw-semibold" href="{{ route('co.profile') }}">
                                        {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
                                    </a>
                                    <p class="fs-sm text-white-75 fw-normal mb-0">
                                        @if(Auth::user()->account_type == 'company' AND isset(Auth::user()->company) )
                                        {{ Auth::user()->company->name }}
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div class="p-2">
                                @if(Auth::user()->account_type == 'company')
                                <a class="dropdown-item" href="{{ route('co.profile') }}">
                                    <i class="fa fa-fw fa-user-circle text-gray me-1"></i>{{ __('Profil') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('co.preferences') }}">
                                    <i class="fa fa-fw fa-cog text-gray me-1"></i> {{ __('Préférences') }}
                                </a>
                                @else
                                <a class="dropdown-item" href="{{ route('in.profile') }}">
                                    <i class="fa fa-fw fa-user-circle text-gray me-1"></i>{{ __('Profil') }}
                                </a>
                                @endif
                                <div role="separator" class="dropdown-divider"></div>
                                @if(Auth::user()->account_type == 'company' AND isset(Auth::user()->company))
                                <a class="dropdown-item" href="{{ route('co') }}">
                                    <i class="fa fa-fw fa-building text-gray me-1"></i>
                                    {{ Auth::user()->company->name }}
                                </a>
                                @else
                                <a class="dropdown-item" href="{{ route('co') }}">
                                    <i class="fa fa-fw fa-wallet me-1"></i>
                                    {{ __('Portefeuille') }}
                                </a>
                                @endif
                                {{-- <a class="dropdown-item" href="{{ route('co') }}">
                                <i class="fa fa-fw fa-wallet text-primary me-1"></i> Portefeuille
                                </a> --}}
                                <div role="separator" class="dropdown-divider"></div>
                                <form class="dropdown-item" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn">
                                        <i class="fa fa-fw fa-arrow-alt-circle-left me-1"></i> {{ __('Déconnexion') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class=" d-inline-block">
                        <a href="{{ route('co') }}" class="btn btn-alt-secondary">
                            <i class="fa fa-fw fa-bell"></i>
                        </a>
                    </div>
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn btn-alt-secondary" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            
                            <span class="d-none d-sm-inline-block"> <span class="fi fi-{{Auth::user()->language == 'en' ? 'us' : Auth::user()->language }}"></span> {{ Auth::user()->language }}</span>
                            <i class="fa fa-fw fa-angle-down opacity-50 ms-1 d-none d-sm-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end p-0" aria-labelledby="page-header-user-dropdown">
                            <div class="p-2">
                                @foreach(config('localization.locales') as $locale => $lang)
                                <form class="dropdown-item" action="{{ route('localization') }}" method="GET">
                                    @csrf
                                    <input type="text" name="locale" id="locale" value="{{ $locale }}" hidden>
                                    <button type="submit" class="btn">
                                        <span class="fi fi-{{$locale == 'en' ? 'us' : $locale}}"></span> {{ $lang}}
                                    </button>
                                </form>
                                 @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="page-header-search" class="overlay-header bg-header-dark">
                <div class="content-header">
                    <form class="w-100" action="/account/" method="POST">
                        @csrf
                        <div class="input-group">
                            <button type="button" class="btn btn-alt-primary" data-toggle="layout" data-action="header_search_off">
                                <i class="fa fa-fw fa-times-circle"></i>
                            </button>
                            <input type="text" class="form-control border-0" placeholder="{{ __('Rechercher ...') }}" id="page-header-search-input" name="page-header-search-input">
                        </div>
                    </form>
                </div>
            </div>

            <div id="page-header-loader" class="overlay-header bg-header-dark">
                <div class="bg-white-10">
                    <div class="content-header">
                        <div class="w-100 text-center">
                            <i class="fa fa-fw fa-sun fa-spin text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main id="main-container">
            {{ $slot }}
        </main>

        <footer id="page-footer" class="bg-body-light">
            <div class="content py-0">
                <div class="row fs-sm">
                    <div class="col-sm-6 order-sm-1 text-center text-sm-start">
                        <a class="fw-semibold" href="https://monicafinance.com" target="_blank">Monica Finance</a> &copy;
                        <span data-toggle="year-copy"></span>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    @yield('jsbtm')
</body>

</html>