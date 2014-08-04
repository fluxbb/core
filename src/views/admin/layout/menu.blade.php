<nav id="navbar" class="navbar navbar-static-top">
    <div class="navbar-inner navbar-inner-light">
        <div class="container">
            <a class="btw btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="{{ $route('admin.index') }}">{{ $board_title }}</a>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li<?php echo (in_array('dashboard', array()) ? ' class="current active"' : '' ); ?> id="nav-dashboard"><a href="#"><i class="icon-dashboard"></i> {{ trans('fluxbb::admin_common.dashboard_menu') }}</a></li>
                    <li<?php echo (in_array('content', array()) ? ' class="current active"' : '' ); ?> id="nav-content"><a href="#"><i class="icon-folder-open"></i> {{ trans('fluxbb::admin_common.content_menu') }}</a></li>
                    <li<?php echo (in_array('users', array()) ? ' class="current active"' : '' ); ?> id="nav-users"><a href="#"><i class="icon-user"></i> {{ trans('fluxbb::admin_common.users_menu') }}</a></li>
                    <li<?php echo (in_array('settings', array()) ? ' class="current active"' : '' ); ?> id="nav-settings"><a href="#"><i class="icon-cogs"></i> {{ trans('fluxbb::admin_common.settings_menu') }}</a></li>
                    <li<?php echo (in_array('extensions', array()) ? ' class="current active"' : '' ); ?> id="nav-extensions"><a href="#"><i class="icon-wrench"></i> {{ trans('fluxbb::admin_common.extensions_menu') }}</a></li>
                </ul>
                <ul class="nav pull-right">
                    @if(Auth::user())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ trans('fluxbb::admin_common.welcome') }} {{ Auth::user()->username }} <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ $route('profile', array('id' => Auth::user()->id)) }}">{{ trans('fluxbb::common.profile') }}</a></li>
                            <li><a href="{{ $route('index') }}">{{ trans('fluxbb::common.forum') }}</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Support</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ $route('logout') }}">{{ trans('fluxbb::common.logout') }}</a></li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
        </div> <!-- /container -->
    </div> <!-- /navbar-inner -->

    <div id="subnavbar" class="navbar-inner navbar-inner-dark">
        <div class="container">
            <div class="nav-collapse collapse">
                <ul class="nav subnav">
                    <li id="subnav-dashboard"<?php echo (in_array('dashboard', array()) ? ' class="active"' : '' ); ?>>
                        <ul class="nav">
                            <li><a href="{{ $route('admin.dashboard.updates') }}"><i class="icon-refresh"></i> {{ trans('fluxbb::admin_common.update_check_submenu') }}</a></li>
                            <li><a href="{{ $route('admin.dashboard.stats') }}"><i class="icon-bar-chart"></i> {{ trans('fluxbb::admin_common.stats_submenu') }}</a></li>
                            <li><a href="{{ $route('admin.dashboard.reports') }}"><i class="icon-flag"></i> {{ trans('fluxbb::admin_common.reported_posts_submenu') }}</a></li>
                        </ul>
                    </li>
                    <li id="subnav-content"<?php echo (in_array('content', array()) ? ' class="active"' : '' ); ?>>
                        <ul class="nav">
                            <li><a href="/content/forums/"><i class="icon-cog"></i> {{ trans('fluxbb::admin_common.forums_submenu') }}</a></li>
                            <li><a href="/content/bbcode/"><i class="icon-code"></i> {{ trans('fluxbb::admin_common.bbcode_submenu') }}</a></li>
                            <li><a href="/content/reports/"><i class="icon-flag"></i> {{ trans('fluxbb::admin_common.spam_reports_submenu') }}</a></li>
                        </ul>
                        <ul class="nav pull-right">
                            <li><a href="/content/"><i class="icon-plus"></i> {{ trans('fluxbb::admin_common.new_forum_submenu') }}</a></li>
                            <li><a href="/content/"><i class="icon-plus"></i> {{ trans('fluxbb::admin_common.new_category_submenu') }}</a></li>
                        </ul>
                    </li>
                    <li id="subnav-users"<?php echo (in_array('users', array()) ? ' class="active"' : '' ); ?>>
                        <ul class="nav">
                            <li><a href="/users/users/"><i class="icon-cog"></i> {{ trans('fluxbb::admin_common.manage_users_submenu') }}</a></li>
                            <li><a href="{{ $route('admin.groups.index') }}"><i class="icon-cog"></i> {{ trans('fluxbb::admin_common.manage_groups_submenu') }}</a></li>
                            <li><a href="/users/permissions/"><i class="icon-key"></i> {{ trans('fluxbb::admin_common.permissions_submenu') }}</a></li>
                            <li><a href="/users/bans/"><i class="icon-lock"></i> {{ trans('fluxbb::admin_common.bans_submenu') }}</a></li>
                        </ul>
                        <!--<ul class="nav pull-right">
                            <li><a href="#"><i class="icon-plus"></i> Add new group</a></li>
                        </ul>-->
                    </li>
                    <li id="subnav-settings"<?php echo (in_array('settings', array()) ? ' class="active"' : '' ); ?>>
                        <ul class="nav">
                            <li><a href="{{ $route('admin.settings.global') }}"><i class="icon-list-alt"></i> {{ trans('fluxbb::admin_common.global_submenu') }}</a></li>
                            <li><a href="{{ $route('admin.settings.email') }}"><i class="icon-envelope-alt"></i> {{ trans('fluxbb::admin_common.email_submenu') }}</a></li>
                            <li><a href="{{ $route('admin.settings.maintenance') }}"><i class="icon-bell-alt"></i> {{ trans('fluxbb::admin_common.maintenance_submenu') }}</a></li>
                            <li><a href="#"><i class="icon-shield"></i> {{ trans('fluxbb::admin_common.logs_submenu') }}</a></li>
                        </ul>
                    </li>
                    <li id="subnav-extensions"<?php echo (in_array('extensions', array()) ? ' class="active"' : '' ); ?>>
                        <ul class="nav">
                            <li><a href="/extensions/manage/"><i class="icon-cog"></i> {{ trans('fluxbb::admin_common.manage_submenu') }}</a></li>
                            <li><a href="/extensions/install/"><i class="icon-download-alt"></i> {{ trans('fluxbb::admin_common.install_submenu') }}</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div> <!-- /container -->
    </div> <!-- /navbar-inner -->
</nav> <!-- /navbar -->

<div class="intro">

    <div class="container">

        <div class="row-fluid">

            <div class="span12 dashbox">
                <ul class="nav nav-pills pull-left">
                    <li><a class="message alert" href="{{ $route('admin.dashboard.updates') }}">Updates <span>6</span></a></li>
                </ul>
            </div>

        </div> <!-- /row-fluid -->

    </div> <!-- /container -->

</div> <!-- /intro -->
