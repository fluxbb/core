<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{{ $language }}" lang="{{ $language }}" dir="{{ $direction }}">
<head>
    <title>{{ $board_title }} - {{ $board_description }}</title>

    <!-- begin meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset={{ $charset }}" />
    <!-- end meta tags -->

    <!-- begin css -->
    <link rel="stylesheet" type="text/css" href="/public/packages/fluxbb/core/frontend/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/public/packages/fluxbb/core/frontend/style.css" />
    <link rel="stylesheet" type="text/css" href="/public/packages/fluxbb/core/frontend/assets/css/entypo.css" />
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400|Telex" rel="stylesheet" type="text/css">
    <!-- end css -->


    <!-- begin shortcut -->
    <link rel="shortcut icon" href="/public/packages/fluxbb/core/img/favicon.ico">
    <!-- end shortcut -->

    <!-- begin js -->
    <script src="/public/packages/fluxbb/core/js/jquery.min.js"></script>
    <script src="/public/packages/fluxbb/core/js/fluxbb.js"></script>
    <script src="/public/packages/fluxbb/core/js/frontend.js"></script>
    <!-- end js -->

</head>

<body id="site-forum">

    <!-- begin board header -->
    <header id="brdheader">
        <div id="brdtitle">
            <h1 class="forum-title">{{ $board_title }}</h1>
            <div class="forum-desc"><p>{{ $board_description }}</p></div>

            @if(\Illuminate\Support\Facades\Auth::user())
            <div class="avatar">
                <!-- TODO: avitar function -->
                <img src="assets/img/cyrano.jpg" alt="" />
            </div>
            @endif
        </div>

        <div id="brdmenu">

            <nav class="menu">
                <ul class="nav nav-pills pull-left">
                    <li class="active"><a href="{{ $route('index') }}">Index</a></li>
                </ul>
                <h3 class="username pull-right">
                @if (\Illuminate\Support\Facades\Auth::user())
                    {{ \Illuminate\Support\Facades\Auth::user()->username }}
                    <a href="{{ $route('profile', array('id' => \Illuminate\Support\Facades\Auth::user()->id)) }}">Profile</a>
                    @if (FluxBB\Models\User::current()->isAdmin())
                    <a href="{{ $route('admin.index') }}">{{ trans('fluxbb::common.admin') }}</a>
                    @endif
                    <a href="{{ $route('logout') }}">Logout</a>
                @else
                    <a href="{{ $route('login') }}">Login</a>
                    <a href="{{ $route('register') }}">Register</a>
                @endif
                </h3>
            </nav>

        </div>

    </header>
    <!-- end board header -->

    <!-- begin forum container -->
    <div class="container">
