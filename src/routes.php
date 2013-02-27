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

$prefix = Config::get('fluxbb.route_prefix', '');

Route::group(array('prefix' => $prefix, 'before' => 'fluxbb_is_installed'), function()
{
	Route::get('forum/{id}', array(
		'as'	=> 'viewforum',
		'uses'	=> 'FluxBB\Controllers\HomeController@get_forum',
	));
	Route::get('topic/{id}', array(
		'as'	=> 'viewtopic',
		'uses'	=> 'FluxBB\Controllers\HomeController@get_topic',
	));
	Route::get('post/{id}', array(
		'as'	=> 'viewpost',
		'uses'	=> 'FluxBB\Controllers\HomeController@get_post',
	));
	Route::get('/', array(
		'as'	=> 'index',
		'uses'	=> 'FluxBB\Controllers\HomeController@get_index',
	));
	Route::get('profile/{id}', array(
		'as'	=> 'profile',
		'uses'	=> 'FluxBB\Controllers\UsersController@get_profile',
	));
	Route::post('profile/{id}', array(
		'uses'	=> 'FluxBB\Controllers\UsersController@post_profile',
	));
	Route::get('users', array(
		'as'	=> 'userlist',
		'uses'	=> 'FluxBB\Controllers\UsersController@get_list',
	));
	Route::get('register', array(
		'as'	=> 'register',
		'uses'	=> 'FluxBB\Controllers\AuthController@get_register',
	));
	Route::post('register', array(
		'uses'	=> 'FluxBB\Controllers\AuthController@post_register',
	));
	Route::get('login', array(
		'as'	=> 'login',
		'uses'	=> 'FluxBB\Controllers\AuthController@get_login',
	));
	Route::post('login', array(
		'uses'	=> 'FluxBB\Controllers\AuthController@post_login',
	));
	Route::get('forgot_password.html', array(
		'as'	=> 'forgot_password',
		'uses'	=> 'FluxBB\Controllers\AuthController@get_forgot',
	));
	Route::get('logout', array(
		'as'	=> 'logout',
		'uses'	=> 'FluxBB\Controllers\AuthController@get_logout',
	));
	Route::get('rules', array(
		'as'	=> 'rules',
		'uses'	=> 'FluxBB\Controllers\MiscController@get_rules',
	));
	Route::get('email/{id}', array(
		'as'	=> 'email',
		'uses'	=> 'FluxBB\Controllers\MiscController@get_email',
	));
	Route::get('search', array(
		'as'	=> 'search',
		'uses'	=> 'FluxBB\Controllers\SearchController@get_index',
	));
	Route::get('post/{id}/report', array(
		'as'	=> 'post_report',
		'uses'	=> 'FluxBB\Controllers\PostingController@get_report',
	));
	Route::get('post/{id}/delete', array(
		'as'	=> 'post_delete',
		'uses'	=> 'FluxBB\Controllers\PostingController@get_delete',
	));
	Route::get('post/{id}/edit', array(
		'as'	=> 'post_edit',
		'uses'	=> 'FluxBB\Controllers\PostingController@get_edit',
	));
	Route::get('post/{id}/quote', array(
		'as'	=> 'post_quote',
		'uses'	=> 'FluxBB\Controllers\PostingController@get_quote',
	));
	Route::get('topic/{id}/reply', array(
		'as'	=> 'reply',
		'uses'	=> 'FluxBB\Controllers\PostingController@get_reply',
	));
	Route::post('topic/{id}/reply', array(
		'uses'	=> 'FluxBB\Controllers\PostingController@post_reply',
	));
	Route::get('forum/{id}/topic/new', array(
		'as'	=> 'new_topic',
		'uses'	=> 'FluxBB\Controllers\PostingController@get_topic',
	));
	Route::post('forum/{id}/topic/new', array(
		'uses'	=> 'FluxBB\Controllers\PostingController@post_topic',
	));

	Route::bind('group', function($value, $route)
	{
		return App::make('FluxBB\Models\GroupRepositoryInterface')->find($value);
	});

	Route::get('admin', array(
		'as'	=> 'admin',
		'uses'	=> 'FluxBB\Controllers\Admin\DashboardController@get_index',
	));

	Route::get('admin/groups', array(
		'as'	=> 'admin_groups_index',
		'uses'	=> 'FluxBB\Controllers\Admin\GroupsController@index',
	));
	Route::get('admin/groups/{group}/edit', array(
		'as'	=> 'admin_groups_edit',
		'uses'	=> 'FluxBB\Controllers\Admin\GroupsController@edit',
	));
	Route::get('admin/groups/{group}/delete', array(
		'as'	=> 'admin_groups_delete',
		'uses'	=> 'FluxBB\Controllers\Admin\GroupsController@delete',
	));
	Route::post('admin/groups/{group}/delete', array(
		'uses'	=> 'FluxBB\Controllers\Admin\GroupsController@remove',
	));

	Route::post('admin/ajax/board_config', array(
		'as'	=> 'admin_ajax_board_config',
		'uses'	=> 'FluxBB\Controllers\Admin\AjaxController@post_board_config',
	));
});

