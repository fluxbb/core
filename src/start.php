<?php

if (FluxBB\Core::isInstalled())
{
	Config::set('database.connections.fluxbb', Config::get('fluxbb.database'));
	DB::setDefaultConnection('fluxbb');
}

// Load our helpers (composers, macros, validators etc.)
include __DIR__.'/helpers.php';

// Add another namespace for localized mail templates
View::addNamespace('fluxbb:mail', __DIR__.'/lang/'.Config::get('app.locale').'/mail/');

/*
// Set up our custom session handler
if (!Request::cli() && !Session::started())
{
	Session::extend('fluxbb::session', function()
	{
		return new fluxbb\Session\Driver(Laravel\Database::connection());
	});

	Config::set('session.driver', 'fluxbb::session');

	Session::load();	
}
*/
