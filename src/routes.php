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

View::addNamespace('fluxbb', __DIR__.'/views/');

Route::group(array('NOTbefore' => 'fluxbb::is_installed'), function()
{
	Route::get('forum/{num}', 'FluxBB\\Controllers\\Home@get_forum');
	Route::get('topic/{num}', 'FluxBB\\Controllers\\Home@get_topic');
	Route::get('post/{num}', 'FluxBB\\Controllers\\Home@get_post');
	Route::get('/', 'FluxBB\\Controllers\\Home@get_index');
	Route::any('profile/{num}/{username}', array('as' => 'profile', 'uses' => 'fluxbb::user@profile'));
	Route::get('user/list', 'FluxBB\\Controllers\\User@get_list');
	Route::any('register', 'FluxBB\\Controllers\\Auth@get_register'); // TODO: "any" should not route to 'get_register'
	Route::any('login', 'FluxBB\\Controllers\\Auth@get_login');
	Route::get('logout', 'FluxBB\\Controllers\\Auth@get_logout');
	Route::get('search', 'FluxBB\\Controllers\\Search@get_index');
	Route::any('topic/{num}/reply', 'FluxBB\\Controllers\\Posting@get_reply');
	Route::any('forum/{num}/new_topic', 'FluxBB\\Controllers\\Posting@get_topic');
});


Route::filter('fluxbb::is_installed', function()
{
	if (!FluxBB\Core::installed())
	{
		return View::make('fluxbb::not_installed')
			->with('has_installer', false);
	}
});

// Load our helpers (composers, macros, validators etc.)
include __DIR__.'/helpers.php';
