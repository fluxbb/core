<?php
/**
 * FluxBB - fast, light, user-friendly PHP forum software
 * Copyright (C) 2008-2012 FluxBB.org
 * based on code by Rickard Andersson copyright (C) 2002-2008 PunBB
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public license for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * @category	FluxBB
 * @package		Core
 * @copyright	Copyright (c) 2008-2012 FluxBB (http://fluxbb.org)
 * @license		http://www.gnu.org/licenses/gpl.html	GNU General Public License
 */

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
