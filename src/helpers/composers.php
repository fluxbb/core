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

use FluxBB\Models\Config;

View::composer('fluxbb::layout.main', function($event)
{
	$view = $event->view;

	$view->with('language', 'en')
	     ->with('direction', 'ltr')
	     ->with('head', '')
	     ->with('page', 'index')
	     ->with('board_title', Config::get('o_board_title'))
	     ->with('board_description', Config::get('o_board_desc'))
	     ->with('navlinks', '<ul><li><a href="#">Home</a></li></ul>')
	     ->with('status', 'You are not logged in.')
	     ->with('announcement', '');
});

View::composer('fluxbb::auth.login', function($event)
{
	$view = $event->view;

	$redirect_url = Session::get('login_redirect', URL::to_action('home@index'));
	$view->with('redirect_url', $redirect_url);
});

View::composer('fluxbb::user.profile.menu', function($event)
{
	$view = $event->view;

	$items = array(
		'essentials'	=> 'Essentials',
		'personal'		=> 'Personal',
		'personality'	=> 'Personality',
		'display'		=> 'Display',
		'privacy'		=> 'Privacy',
	);

	if (Auth::check() && Auth::user()->isAdmin())
	{
		$items['admin'] = 'Administration';
	}

	// TODO: Determine current action
	$view->with('action', 'profile')
	     ->with('items', $items);
});

View::composer('fluxbb::admin.layout.header', function($event)
{
	$view = $event->view;
	$view->with('board_title', Config::get('o_board_title'))
	     ->with('board_description', Config::get('o_board_desc'));
});
