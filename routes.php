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

Route::group(array('before' => 'fluxbb_is_installed'), function()
{
	Route::get('forum/{id}', array(
		'as'	=> 'viewforum',
		'uses'	=> 'FluxBB\Controllers\Home@get_forum',
	));
	Route::get('topic/{id}', array(
		'as'	=> 'viewtopic',
		'uses'	=> 'FluxBB\Controllers\Home@get_topic',
	));
	Route::get('post/{id}', array(
		'as'	=> 'viewpost',
		'uses'	=> 'FluxBB\Controllers\Home@get_post',
	));
	Route::get('/', array(
		'as'	=> 'index',
		'uses'	=> 'FluxBB\Controllers\Home@get_index',
	));
	Route::get('profile/{id}', array(
		'as'	=> 'profile',
		'uses'	=> 'FluxBB\Controllers\User@get_profile',
	));
	Route::post('profile/{id}', array(
		'uses'	=> 'FluxBB\Controllers\User@post_profile',
	));
	Route::get('users', array(
		'as'	=> 'userlist',
		'uses'	=> 'FluxBB\Controllers\User@get_list',
	));
	Route::get('register', array(
		'as'	=> 'register',
		'uses'	=> 'FluxBB\Controllers\Auth@get_register',
	));
	Route::post('register', array(
		'uses'	=> 'FluxBB\Controllers\Auth@post_register',
	));
	Route::get('login', array(
		'as'	=> 'login',
		'uses'	=> 'FluxBB\Controllers\Auth@get_login',
	));
	Route::post('login', array(
		'uses'	=> 'FluxBB\Controllers\Auth@post_login',
	));
	Route::get('forgot_password.html', array(
		'as'	=> 'forgot_password',
		'uses'	=> 'FluxBB\Controllers\Auth@get_forgot',
	));
	Route::get('logout', array(
		'as'	=> 'logout',
		'uses'	=> 'FluxBB\Controllers\Auth@get_logout',
	));
	Route::get('rules', array(
		'as'	=> 'rules',
		'uses'	=> 'FluxBB\Controllers\Misc@get_rules',
	));
	Route::get('email/{id}', array(
		'as'	=> 'email',
		'uses'	=> 'FluxBB\Controllers\Misc@get_email',
	));
	Route::get('search', array(
		'as'	=> 'search',
		'uses'	=> 'FluxBB\Controllers\Search@get_index',
	));
	Route::get('post/{id}/report', array(
		'as'	=> 'post_report',
		'uses'	=> 'FluxBB\Controllers\Posting@get_report',
	));
	Route::get('post/{id}/delete', array(
		'as'	=> 'post_delete',
		'uses'	=> 'FluxBB\Controllers\Posting@get_delete',
	));
	Route::get('post/{id}/edit', array(
		'as'	=> 'post_edit',
		'uses'	=> 'FluxBB\Controllers\Posting@get_edit',
	));
	Route::get('post/{id}/quote', array(
		'as'	=> 'post_quote',
		'uses'	=> 'FluxBB\Controllers\Posting@get_quote',
	));
	Route::get('topic/{id}/reply', array(
		'as'	=> 'reply',
		'uses'	=> 'FluxBB\Controllers\Posting@get_reply',
	));
	Route::post('topic/{id}/reply', array(
		'uses'	=> 'FluxBB\Controllers\Posting@post_reply',
	));
	Route::get('forum/{id}/topic/new', array(
		'as'	=> 'new_topic',
		'uses'	=> 'FluxBB\Controllers\Posting@get_topic',
	));
	Route::post('forum/{id}/topic/new', array(
		'uses'	=> 'FluxBB\Controllers\Posting@post_topic',
	));

	Route::get('admin', array(
		'as'	=> 'admin',
		'uses'	=> 'FluxBB\Controllers\Admin\Dashboard@get_index',
	));
});

