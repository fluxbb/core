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
				<li id="navindex" class="isactive"><a href="{{ URL::to_action('fluxbb::home@index') }}">{{ __('fluxbb::common.index') }}</a></li>
@if (fluxbb\Models\User::current()->group->g_read_board == '1' && fluxbb\Models\User::current()->group->g_view_users == '1')
				<li id="navuserlist"><a href="{{ URL::to_action('fluxbb::user@list') }}">{{ __('fluxbb::common.user_list') }}</a></li>
@endif
@if (fluxbb\Models\Config::enabled('o_rules') && (Auth::check() || fluxbb\Models\User::current()->group->g_read_board == '1' || fluxbb\Models\Config::enabled('o_regs_allow')))
				<li id="navrules"><a href="{{ URL::to_action('fluxbb::misc@rules') }}">{{ __('fluxbb::common.rules') }}</a></li>
@endif
@if (fluxbb\Models\User::current()->group->g_read_board == '1' && fluxbb\Models\User::current()->group->g_search == '1')
				<li id="navsearch"><a href="{{ URL::to_action('fluxbb::search@index') }}">{{ __('fluxbb::common.search') }}</a></li>
@endif
@if (Auth::guest())
				<li id="navregister"><a href="{{ URL::to_action('fluxbb::auth@register') }}">{{ __('fluxbb::common.register') }}</a></li>
				<li id="navlogin"><a href="{{ URL::to_action('fluxbb::auth@login') }}">{{ __('fluxbb::common.login') }}</a></li>
@else
				<li id="navprofile">{{ HTML::link_to_action('fluxbb::user@profile', __('fluxbb::common.profile'), array(Auth::user()->id)) }}</li>
	@if (fluxbb\Models\User::current()->is_admin())
				<li id="navadmin"><a href="{{ URL::to_action('fluxbb::admin@index') }}">{{ __('fluxbb::common.admin') }}</a></li>
	@endif
				<li id="navlogout"><a href="{{ URL::to_action('fluxbb::auth@logout') }}">{{ __('fluxbb::common.logout') }}</a></li>
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

@if (Session::has('message'))
	<div>
		<p style="color: #9F6000; background-color: #FEEFB3; border: 1px solid #9F6000; padding: 5px; margin-bottom: 10px;">{{ e(Session::get('message')) }}</p>
	</div>
@endif

@if (Session::has('errors'))
	<div id="posterror" class="block">
		<h2><span>Errors</span></h2>
		<div class="box">
			<div class="inbox error-info">
				<p>The following errors need to be corrected:</p>
				{{ HTML::ul(Session::get('errors')->all(), array('class' => 'error-list')) }}
			</div>
		</div>
	</div>
@endif

@yield('main')

</div>

@include('fluxbb::layout.partials.footer')

</div>
<div class="end-box"><div><!-- Bottom corners --></div></div>
</div>

</body>
</html>
