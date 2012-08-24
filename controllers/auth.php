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

use fluxbb\Controllers\Base,
	fluxbb\Models\Config,
	fluxbb\Models\User;

class FluxBB_Auth_Controller extends Base
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
		$login_data = array(
			'username'	=> Input::get('req_username'),
			'password'	=> Input::get('req_password'),
			'remember'	=> !is_null(Input::get('save_pass')),
		);

		if (Auth::attempt($login_data))
		{
			// TODO: This is properly validated in URL::to, right?
			$redirect_url = Input::get('redirect_url', URL::to_action('fluxbb::home@index'));
			return Redirect::to($redirect_url)
				->with('message', 'You were successfully logged in.');
		}
		else
		{
			$errors = new Laravel\Messages;
			$errors->add('login', 'Invalid username / password combination.');

			return Redirect::back()
				->with_input()
				->with_errors($errors);
		}
	}

	public function get_register()
	{
		return View::make('fluxbb::auth.register');
	}

	public function post_register()
	{
		// TODO: Add agreement to rules here!
		
		if(Config::enabled('o_regs_verify')) // If email confirmation is enabled
		{
			$email_rules = 'required|email|confirmed|unique:users,email';
		}
		else
		{
			$email_rules = 'required|email|unique:users,email';
		}
		
		$rules = array(
			// TODO: Reserved chars, BBCode, IP + case-insensitivity for "Guest", censored words, name doesn't exist
			'req_user'		=> 'required|min:2|max:25|not_in:Guest,'.__('fluxbb::common.guest'),
			// TODO: No password if o_regs_verify == 1
			'req_password'	=> 'required|min:4|confirmed',
			// TODO: add check for banned email
			'req_email'		=> $email_rules,
		);

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
			'email_setting'		=> Config::get('o_default_email_setting'),
			'timezone'			=> Config::get('o_default_timezone'),
			'dst'				=> Config::get('o_default_dst'),
			'language'			=> Config::get('o_default_language'),
			'style'				=> Config::get('o_default_style'),
			'registered'		=> Request::time(),
			'registration_ip'	=> Request::ip(),
			'last_visit'		=> Request::time(),
		);
		$user = User::create($user_data);
	
		return Redirect::to_action('fluxbb::user@profile', array($user->id))->with('message', __('fluxbb::register.reg_complete'));
	}

}
