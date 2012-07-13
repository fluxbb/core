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

use fluxbb\User;

class FluxBB_Auth_Controller extends FluxBB_BaseController
{

	public function __construct()
	{
		parent::__construct();

		$this->filter('before', 'fluxbb::only_guests')->only(array('login', 'remember'));
		$this->filter('before', 'fluxbb::only_members')->only('logout');
	}
	
	public function get_logout()
	{
		Auth::logout();
		return Redirect::to_action('fluxbb::home@index')->with('message', __('fluxbb::login.message_logout'));
	}
	
	public function get_login()
	{
		return View::make('fluxbb::auth.login');
	}

	public function post_login()
	{
		// TODO: Validate maybe?
		$rules = array(
			'req_username'	=> 'required',
			'req_password'	=> 'required',
			'redirect_url'	=> 'url',
		);

		$validation = Validator::make(Input::all(), $rules);
		if ($validation->fails())
		{
			return Redirect::to_action('fluxbb::auth@login')->with_errors($validation);
		}

		$login_data = array(
			'username'	=> Input::get('req_username'),
			'password'	=> Input::get('req_password'),
			'remember'	=> Input::get('save_pass', '0') == '1',
		);

		if (Auth::attempt($login_data))
		{
			$redirect_url = Input::get('redirect_url', URL::to_action('fluxbb::home@index'));
			return Redirect::to($redirect_url)
				->with('message', 'You were successfully logged in.');
		}
		else
		{
			return View::make('fluxbb::auth.login')
				->with('error', 'Invalid username / password combination.');
		}
	}

	public function get_register()
	{
		// TODO: Remember old values, too
		$timezone = 1; // $pun_config['o_default_timezone']
		$dst = 1; // $pun_config['o_default_dst']
		$languages = array('en' => 'English', 'fr' => 'French'); // forum_language_list()
		$email_setting = 1; // $pun_config['o_default_email_setting']

		return View::make('fluxbb::auth.register')
			->with('timezone', $timezone)
			->with('dst', $dst)
			->with('languages', $languages)
			->with('email_setting', $email_setting);
	}

	public function post_register()
	{
		// TODO: Add agreement to rules here!

		$rules = array(
			// TODO: Reserved chars, BBCode, IP + case-insensitivity for "Guest", censored words, name doesn't exist
			'req_user'		=> 'required|min:2|max:25|not_in:Guest,'.__('fluxbb::common.guest'),
			// TODO: No password if o_regs_verify == 1
			'req_password'	=> 'required|min:4|confirmed',
			// TODO: only check for confirmation if o_regs_verify == 1, also add check for banned email
			'req_email'		=> 'required|email|confirmed|unique:users,email',
		);
		// TODO: More validation

		$validation = Validator::make(Input::all(), $rules);
		if ($validation->fails())
		{
			return Redirect::to_action('fluxbb::auth@register')->with_errors($validation);
		}

		$user_data = array(
			'username'			=> Input::get('req_user'),
			'group_id'			=> 4, // TODO: ($pun_config['o_regs_verify'] == '0') ? $pun_config['o_default_user_group'] : PUN_UNVERIFIED
			'password'			=> Input::get('req_password'),
			'email'				=> Input::get('req_email'),
			'email_setting'		=> Input::get('email_setting'),
			'timezone'			=> Input::get('timezone'), // TODO: default to $pun_config['o_default_dst']
			'dst'				=> Input::get('dst'),
			'language'			=> Input::get('language'),
			'style'				=> 'Air', // TODO: Default style!!!
			'registered'		=> time(), // TODO: Request::time()? https://github.com/laravel/laravel/pull/933
			'registration_ip'	=> Request::ip(),
			'last_visit'		=> time(),
		);
		$user = User::create($user_data);
	
		return Redirect::to_action('fluxbb::user@profile', array($user->id))->with('message', __('fluxbb::register.reg_complete'));
	}

}
