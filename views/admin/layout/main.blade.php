<!DOCTYPE html>

<html lang="{{ $direction }}" dir="{{ $language }}">

    <head>

        <meta charset="{{ $charset }}">

        <title>{{ $board_title }} | {{ trans('fluxbb::common.admin') }}</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        {{ $load('bootstrap-fluxbb', 'vendor/fluxbb/core/public/css/bootstrap-fluxbb.css') }}
        {{ $load('morris-css', 'vendor/fluxbb/core/public/css/morris.min.css') }}
        {{ $load('font-awesome', 'vendor/fluxbb/core/public/css/font-awesome.min.css') }}
        {{ $load('main', 'vendor/fluxbb/core/public/css/main.css') }}

        <link rel="shortcut icon" href="{{ $asset('vendor/fluxbb/core/public/img/favicon.ico') }}">

        {{ $load('jquery', 'vendor/fluxbb/core/public/js/jquery-1.9.1.min.js') }}
        {{ $load('raphael', 'vendor/fluxbb/core/public/js/raphael.min.js') }}
        {{ $load('morris-js', 'vendor/fluxbb/core/public/js/morris.min.js') }}
        {{ $load('bootstrap', 'vendor/fluxbb/core/public/js/bootstrap.min.js') }}
        {{ $load('application', 'vendor/fluxbb/core/public/js/application.js') }}
        {{ $load('fluxbb', 'vendor/fluxbb/core/public/js/fluxbb.js') }}
        {{ $load('admin', 'vendor/fluxbb/core/public/js/admin.js') }}

        {!! $assets() !!}

    </head>

    <body>

        @include('fluxbb::admin.layout.menu')


        @yield('alerts')

        @yield('main')


        <footer class="footer">

            <div class="container">

                <p class="muted pull-right">FluxBB {{ $version }} &copy; <a href="http://fluxbb.org" target="_blank">FluxBB</a> 2013</p>

            </div>

        </footer>

    </body>

</html>
