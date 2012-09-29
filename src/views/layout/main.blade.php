<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>

<div id="brdheader" class="block">
	<div class="box">
		<div id="brdtitle" class="inbox">
			<h1><a href="{{ URL::action('fluxbb::home@index') }}">Board title</a></h1>
			<div id="brddesc">Board description</div>
		</div>
		<div id="brdmenu" class="inbox">
			<ul>
				<!-- TODO: Class isactive -->
				<li id="navindex" class="isactive"><a href="{{ URL::action('fluxbb::home@index') }}">{{ trans('fluxbb::common.index') }}</a></li>
@if (FluxBB\Models\User::current()->group->g_read_board == '1' && FluxBB\Models\User::current()->group->g_view_users == '1')
				<li id="navuserlist"><a href="{{ URL::action('fluxbb::user@list') }}">{{ trans('fluxbb::common.user_list') }}</a></li>
@endif
@if (FluxBB\Models\Config::enabled('o_rules') && (Auth::check() || FluxBB\Models\User::current()->group->g_read_board == '1' || FluxBB\Models\Config::enabled('o_regs_allow')))
				<li id="navrules"><a href="{{ URL::action('fluxbb::misc@rules') }}">{{ trans('fluxbb::common.rules') }}</a></li>
@endif
@if (FluxBB\Models\User::current()->group->g_read_board == '1' && FluxBB\Models\User::current()->group->g_search == '1')
				<li id="navsearch"><a href="{{ URL::action('fluxbb::search@index') }}">{{ trans('fluxbb::common.search') }}</a></li>
@endif
@if (Auth::isGuest())
				<li id="navregister"><a href="{{ URL::action('fluxbb::auth@register') }}">{{ trans('fluxbb::common.register') }}</a></li>
				<li id="navlogin"><a href="{{ URL::action('fluxbb::auth@login') }}">{{ trans('fluxbb::common.login') }}</a></li>
@else
				<li id="navprofile"><a href="{{ URL::action('fluxbb::user@profile', array(Auth::user()->id)) }}">{{ trans('fluxbb::common.profile') }}</a></li>
	@if (FluxBB\Models\User::current()->isAdmin())
				<li id="navadmin"><a href="{{ URL::action('fluxbb::admin@index') }}">{{ trans('fluxbb::common.admin') }}</a></li>
	@endif
				<li id="navlogout"><a href="{{ URL::action('fluxbb::auth@logout') }}">{{ trans('fluxbb::common.logout') }}</a></li>
@endif
			</ul>
		</div>
	</div>
</div>

<div id="brdmain">

@if (Session::has('message'))
	<div>
		<p style="color: #9F6000; background-color: #FEEFB3; border: 1px solid #9F6000; padding: 5px; margin-bottom: 10px;">{{ Session::get('message') }}</p>{{-- TODO: Escape --}}
	</div>
@endif

@if (Session::has('errors'))
	<div id="posterror" class="block">
		<h2><span>Errors</span></h2>
		<div class="box">
			<div class="inbox error-info">
				<p>The following errors need to be corrected:</p>
				<ul class="error-list">
@foreach (Session::get('errors')->all() as $error)
					<li>{{ $error }}</li>
@endforeach
				</ul>
				{{-- HTML::ul(Session::get('errors')->all(), array('class' => 'error-list')) --}}
			</div>
		</div>
	</div>
@endif

@yield('main')

</div>

@include('fluxbb::layout.partials.footer')

</body>
</html>
