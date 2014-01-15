<?php

Route::filter('fluxbb_is_installed', function()
{
	if (!FluxBB\Core::isInstalled())
	{
		return View::make('fluxbb::not_installed')
			->with('has_installer', false);
	}
});

Route::filter('only_guests', function()
{
	if (!Auth::guest())
	{
		return Redirect::to_action('home@index');
	}
});

Route::filter('only_members', function()
{
	if (!Auth::check())
	{
		return Redirect::to_action('auth@login')
			->with('message', trans('common.login_to_view'))
			->with('login_redirect', URL::current()); // TODO: URL::current() is not yet implemented
	}
});
