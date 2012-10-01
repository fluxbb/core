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
Lang::addNamespace('fluxbb', __DIR__.'/language/');

Route::group(array('NOTbefore' => 'fluxbb::is_installed'), function()
{
	Route::get('forum/{fid}', array(
		'as'	=> 'viewforum',
		'uses'	=> 'FluxBB\\Controllers\\Home@get_forum',
	));
	Route::get('topic/{tid}', array(
		'as'	=> 'viewtopic',
		'uses'	=> 'FluxBB\\Controllers\\Home@get_topic',
	));
	Route::get('post/{pid}', array(
		'as'	=> 'viewpost',
		'uses'	=> 'FluxBB\\Controllers\\Home@get_post',
	));
	Route::get('/', array(
		'as'	=> 'index',
		'uses'	=> 'FluxBB\\Controllers\\Home@get_index',
	));
	Route::get('profile/{uid}/{username}', array(
		'as'	=> 'profile',
		'uses'	=> 'FluxBB\\Controllers\\User@get_profile',
	));
	Route::put('profile/{uid}/{username}', array(
		'uses'	=> 'FluxBB\\Controllers\\User@put_profile',
	));
	Route::get('user/list', array(
		'as'	=> 'userlist',
		'uses'	=> 'FluxBB\\Controllers\\User@get_list',
	));
	Route::get('register', array(
		'as'	=> 'register',
		'uses'	=> 'FluxBB\\Controllers\\Auth@get_register',
	));
	Route::post('register', array(
		'uses'	=> 'FluxBB\\Controllers\\Auth@post_register',
	));
	Route::get('login', array(
		'as'	=> 'login',
		'uses'	=> 'FluxBB\\Controllers\\Auth@get_login',
	));
	Route::post('login', array(
		'uses'	=> 'FluxBB\\Controllers\\Auth@post_login',
	));
	Route::get('logout', array(
		'as'	=> 'logout',
		'uses'	=> 'FluxBB\\Controllers\\Auth@get_logout',
	));
	Route::get('search', array(
		'as'	=> 'search',
		'uses'	=> 'FluxBB\\Controllers\\Search@get_index',
	));
	Route::get('topic/{tid}/reply', array(
		'as'	=> 'reply',
		'uses'	=> 'FluxBB\\Controllers\\Posting@get_reply',
	));
	Route::put('topic/{tid}/reply', array(
		'uses'	=> 'FluxBB\\Controllers\\Posting@put_reply',
	));
	Route::get('forum/{fid}/topic/new', array(
		'as'	=> 'new_topic',
		'uses'	=> 'FluxBB\\Controllers\\Posting@get_topic',
	));
	Route::put('forum/{fid}/topic/new', array(
		'uses'	=> 'FluxBB\\Controllers\\Posting@put_topic',
	));
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
