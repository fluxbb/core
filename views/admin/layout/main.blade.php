<!DOCTYPE html>

<html lang="{{ $direction }}" dir="{{ $language }}">

    <head>

        <meta charset="{{ $charset }}">

        <title>{{ $board_title }} | {{ trans('fluxbb::common.admin') }}</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        {{ $asset('bootstrap-fluxbb', '/vendor/fluxbb/core/public/css/bootstrap-fluxbb.css') }}
        {{ $asset('morris-css', '/vendor/fluxbb/core/public/css/morris.min.css') }}
        {{ $asset('font-awesome', '/vendor/fluxbb/core/public/css/font-awesome.min.css') }}
        {{ $asset('main', '/vendor/fluxbb/core/public/css/main.css') }}

        <link rel="shortcut icon" href="/vendor/fluxbb/core/public/img/favicon.ico">

        {{ $asset('jquery', '/vendor/fluxbb/core/public/js/jquery-1.9.1.min.js') }}
        {{ $asset('raphael', '/vendor/fluxbb/core/public/js/raphael.min.js') }}
        {{ $asset('morris-js', '/vendor/fluxbb/core/public/js/morris.min.js') }}
        {{ $asset('bootstrap', '/vendor/fluxbb/core/public/js/bootstrap.min.js') }}
        {{ $asset('application', '/vendor/fluxbb/core/public/js/application.js') }}
        {{ $asset('fluxbb', '/vendor/fluxbb/core/public/js/fluxbb.js') }}
        {{ $asset('admin', '/vendor/fluxbb/core/public/js/admin.js') }}

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
