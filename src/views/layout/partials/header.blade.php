<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{{ $language }}" lang="{{ $language }}" dir="{{ $direction }}">
<head>
    <title>{{ $board_title }} - {{ $board_description }}</title>

    <!-- begin meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset={{ $charset }}" />
    <!-- end meta tags -->

    <!-- begin css -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('packages/fluxbb/core/frontend/bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('packages/fluxbb/core/frontend/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('packages/fluxbb/core/frontend/assets/css/entypo.css') }}" />
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400|Telex" rel="stylesheet" type="text/css">
    <!-- end css -->


    <!-- begin shortcut -->
    <link rel="shortcut icon" href="{{ URL::asset('packages/fluxbb/core/img/favicon.ico') }}">
    <!-- end shortcut -->

    <!-- begin js -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <!-- end js -->

</head>

<body id="site-forum">

    <!-- begin forum container -->
    <div class="container">

        <!-- begin board header -->
        <header id="brdheader">
            <div id="brdtitle">
                <h1 class="forum-title">{{ $board_title }}</h1>
                <div class="forum-desc"><p>{{ $board_description }}</p></div>
            </div>

            <div id="brdmenu">

                @if(Auth::user())
                <div class="avatar">
                    <!-- TODO: avitar function -->
                    <img src="assets/img/cyrano.jpg" alt="" />
                </div>

                <nav class="menu">
                    <h3 class="username pull-left">{{ Auth::user()->username }} <a href="{{ $route('profile', array('id' => Auth::user()->id)) }}"><span class="edit-profile">Edit Profile</span></a></h3>
                        <ul class="nav nav-pills pull-right">
                            <li><a href="searched.html">Posted</a></li>
                            <li><a href="searched.html">New</a></li>
                            <li><a href="searched.html">Active</a></li>
                            <li><a href="searched.html">Unanswered</a></li>
                        </ul>
                </nav>
                @endif

            </div>

        </header>
        <!-- end board header -->

        <!-- begin board menu -->
        <div id="brdwelcome" class="clearfix">

            @if (Auth::user())
            <ul class="nav nav-pills pull-left">
                <li class="isactive"><a href="{{ $route('index') }}">Index</a></li>
                @if (FluxBB\Models\User::current()->group->g_read_board == '1' && FluxBB\Models\User::current()->group->g_view_users == '1')
                <li id="navuserlist"><a href="{{ $route('userlist') }}">{{ trans('fluxbb::common.user_list') }}</a></li>
                @endif
                @if (FluxBB\Models\Config::enabled('o_rules') && (Auth::check() || FluxBB\Models\User::current()->group->g_read_board == '1' || FluxBB\Models\Config::enabled('o_regs_allow')))
                <li id="navrules"><a href="{{ $route('rules') }}">{{ trans('fluxbb::common.rules') }}</a></li>
                @endif
                @if (FluxBB\Models\User::current()->group->g_read_board == '1' && FluxBB\Models\User::current()->group->g_search == '1')
                <li id="navsearch"><a href="{{ $route('search') }}">{{ trans('fluxbb::common.search') }}</a></li>
                @endif
                @if (FluxBB\Models\User::current()->isAdmin())
                <li id="navadmin"><a href="{{ $route('admin.index') }}">{{ trans('fluxbb::common.admin') }}</a></li>
                @endif
                <li id="navprofile"><a href="{{ $route('profile', array('id' => FluxBB\Models\User::current()->id)) }}">Profile</a></li>
                <li id="navlogout"><a href="{{ $route('logout') }}">Logout</a></li>
            </ul>
            @else
            <ul class="nav nav-pills pull-left">
                <li class="active"><a href="{{ $route('index') }}">Index</a></li>
                <li><a href="{{ $route('login') }}">Login/Register</a></li>
            </ul>
            @endif

        </div>
        <!-- end board menu -->

