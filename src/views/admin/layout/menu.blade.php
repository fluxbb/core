<nav id="navbar" class="navbar navbar-static-top">
    <div class="navbar-inner navbar-inner-light">
        <div class="container">
            <a class="btw btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="{{ route('admin') }}">FluxBB</a>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li<?php echo (in_array('dashboard', array()) ? ' class="current active"' : '' ); ?> id="nav-dashboard"><a href="#"><i class="icon-dashboard"></i> Dashboard</a></li>
                    <li<?php echo (in_array('content', array()) ? ' class="current active"' : '' ); ?> id="nav-content"><a href="#"><i class="icon-folder-open"></i> Content</a></li>
                    <li<?php echo (in_array('users', array()) ? ' class="current active"' : '' ); ?> id="nav-users"><a href="#"><i class="icon-user"></i> Users</a></li>
                    <li<?php echo (in_array('settings', array()) ? ' class="current active"' : '' ); ?> id="nav-settings"><a href="#"><i class="icon-cogs"></i> Settings</a></li>
                    <li<?php echo (in_array('extensions', array()) ? ' class="current active"' : '' ); ?> id="nav-extensions"><a href="#"><i class="icon-wrench"></i> Extensions</a></li>
                </ul>
                <ul class="nav pull-right">
                    @if(Auth::user())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome, {{ Auth::user()->username }} <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Profile</a></li>
                            <li><a href="#">Forum</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Support</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('logout') }}">Logout</a></li>
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
                            <li><a href="{{ route('admin_dashboard_updates') }}"><i class="icon-refresh"></i> Update check</a></li>
                            <li><a href="{{ route('admin_dashboard_stats') }}"><i class="icon-bar-chart"></i> Stats</a></li>
                            <li><a href="{{ route('admin_dashboard_reports') }}"><i class="icon-flag"></i> Reported posts</a></li>
                            <li><a href="{{ route('admin_dashboard_notes') }}"><i class="icon-edit-sign"></i> Notes</a></li>
                            <li><a href="{{ route('admin_dashboard_backup') }}"><i class="icon-save"></i> Backup</a></li>
                        </ul>
                    </li>
                    <li id="subnav-content"<?php echo (in_array('content', array()) ? ' class="active"' : '' ); ?>>
                        <ul class="nav">
                            <li><a href="/content/forums/"><i class="icon-cog"></i> Forums</a></li>
                            <li><a href="/content/bbcode/"><i class="icon-code"></i> BBCode</a></li>
                            <li><a href="/content/censoring/"><i class="icon-microphone-off"></i> Censoring</a></li>
                            <!--<li><a href="/content/reports/"><i class="icon-flag"></i> Spam / Reports</a></li>-->
                        </ul>
                        <!--<ul class="nav pull-right">
                            <li><a href="/content/"><i class="icon-plus"></i> Add new forum</a></li>
                            <li><a href="/content/"><i class="icon-plus"></i> Add new category</a></li>
                        </ul>-->
                    </li>
                    <li id="subnav-users"<?php echo (in_array('users', array()) ? ' class="active"' : '' ); ?>>
                        <ul class="nav">
                            <li><a href="/users/users/"><i class="icon-cog"></i> Manage users</a></li>
                            <li><a href="{{ route('admin_groups_index') }}"><i class="icon-cog"></i> Manage groups</a></li>
                            <li><a href="/users/permissions/"><i class="icon-key"></i> Permissions</a></li>
                            <li><a href="/users/bans/"><i class="icon-lock"></i> Bans</a></li>
                        </ul>
                        <!--<ul class="nav pull-right">
                            <li><a href="#"><i class="icon-plus"></i> Add new group</a></li>
                        </ul>-->
                    </li>
                    <li id="subnav-settings"<?php echo (in_array('settings', array()) ? ' class="active"' : '' ); ?>>
                        <ul class="nav">
                            <li><a href="{{ route('admin_settings_global') }}"><i class="icon-list-alt"></i> Global</a></li>
                            <li><a href="{{ route('admin_settings_email') }}"><i class="icon-envelope-alt"></i> Email</a></li>
                            <li><a href="{{ route('admin_settings_maintenance') }}"><i class="icon-bell-alt"></i> Maintenance</a></li>
                            <li><a href="#"><i class="icon-shield"></i> Logs</a></li>
                        </ul>
                    </li>
                    <li id="subnav-extensions"<?php echo (in_array('extensions', array()) ? ' class="active"' : '' ); ?>>
                        <ul class="nav">
                            <li><a href="/extensions/manage/"><i class="icon-cog"></i> Manage</a></li>
                            <li><a href="/extensions/install/"><i class="icon-download-alt"></i> Install</a></li>
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
                    <li><a class="message alert" href="/dashboard/updates/">Updates <span>6</span></a></li>
                </ul>
                <ul class="nav nav-pills pull-right">
                    <li><a href="#">You have 2 notes awaiting.</a></li>
                    <li><a class="message success" href="#">New note <i class="icon-plus"></i></a></li>
                </ul>
            </div>

        </div> <!-- /row-fluid -->

    </div> <!-- /container -->

</div> <!-- /intro -->
