<!doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>Monica Finance - Investissement &amp; Finances</title>

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
        @yield('css')
        @vite(['resources/sass/main.scss', 'resources/js/dashmix/app.js'])

        <!-- Alternatively, you can also include a specific color theme after the main stylesheet to alter the default color theme of the template -->
        {{-- @vite(['resources/sass/main.scss', 'resources/sass/dashmix/themes/xwork.scss', 'resources/js/dashmix/app.js']) --}}
        @yield('js')
    </head>

    <body>
        <main id="main-container">
            <div class="hero-static bg-body-extra-light">
                {{$slot}}
            </div>
        </main>
    </body>
</html>
