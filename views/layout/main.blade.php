<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{{ $language }}" lang="{{ $language }}" dir="{{ $direction }}">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
{{ HTML::style('css/themes/Air/base_admin.css') }}
{{ HTML::style('css/themes/Air/Air.css') }}
{{ $head }}
</head>

<body>

<div id="pun{{ $page }}" class="pun">
<div class="top-box"><div><!-- Top Corners --></div></div>
<div class="punwrap">

<div id="brdheader" class="block">
	<div class="box">
		<div id="brdtitle" class="inbox">
			<h1><a href="{{ URL::to_action('fluxbb::home@index') }}">{{ e($title) }}</a></h1>
			<div id="brddesc">{{ $desc }}</div>
		</div>
		<div id="brdmenu" class="inbox">
			<ul>
				<!-- TODO: Class isactive -->
				<li id="navindex" class="isactive"><a href="{{ URL::to_action('fluxbb::home@index') }}">{{ __('Index') }}</a></li>
@if (fluxbb\User::current()->group->g_read_board == '1' && fluxbb\User::current()->group->g_view_users == '1')
				<li id="navuserlist"><a href="{{ URL::to_action('fluxbb::user@list') }}">{{ __('User list') }}</a></li>
@endif
<!-- TODO: First: $pun_config['o_rules'] == '1'; second: $pun_config['o_regs_allow'] == '1' -->
@if (true && (Auth::check() || fluxbb\User::current()->group->g_read_board == '1' || true))
				<li id="navrules"><a href="{{ URL::to_action('fluxbb::misc@rules') }}">{{ __('Rules') }}</a></li>
@endif
@if (fluxbb\User::current()->group->g_read_board == '1' && fluxbb\User::current()->group->g_search == '1')
				<li id="navsearch"><a href="{{ URL::to_action('fluxbb::search@index') }}">{{ __('Search') }}</a></li>
@endif
@if (Auth::guest())
				<li id="navregister"><a href="{{ URL::to_action('fluxbb::auth@register') }}">{{ __('Register') }}</a></li>
				<li id="navlogin"><a href="{{ URL::to_action('fluxbb::auth@login') }}">{{ __('Login') }}</a></li>
@else
				<li id="navprofile"><a href="{{ URL::to_action('fluxbb::user@profile') }}">{{ __('Profile') }}</a></li>
	@if (fluxbb\User::current()->is_admin())
				<li id="navadmin"><a href="{{ URL::to_action('fluxbb::admin@index') }}">{{ __('Administration') }}</a></li>
	@endif
				<li id="navlogout"><a href="{{ URL::to_action('fluxbb::auth@logout') }}">{{ __('Logout') }}</a></li>
@endif
			</ul>
		</div>
		<div id="brdwelcome" class="inbox">
			<p class="conl">{{ $status }}</p>
			<ul class="conr">
				<li><span>Topics: <a href="search.php?action=show_recent" title="Find topics with recent posts.">Active</a> | <a href="search.php?action=show_unanswered" title="Find topics with no replies.">Unanswered</a></span></li>
			</ul>
			<div class="clearer"></div>
		</div>
	</div>
</div>

{{ $announcement }}

<div id="brdmain">
@yield('main')
</div>

@include('fluxbb::layout.partials.footer')

</div>
<div class="end-box"><div><!-- Bottom corners --></div></div>
</div>

</body>
</html>
