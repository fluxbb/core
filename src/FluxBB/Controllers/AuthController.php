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

namespace FluxBB\Controllers;

use FluxBB\Models\Config,
	FluxBB\Models\Group,
	FluxBB\Models\User;
use Auth;
use Input;
use Redirect;
use Request;
use Session;
use Validator;
use View;

class AuthController extends BaseController
{

	public function __construct()
	{
		//$this->filter('before', 'only_guests')->only(array('login', 'remember'));
		//$this->filter('before', 'only_members')->only('logout');
	}
	
	public function get_logout()
	{
		Auth::logout();
		return Redirect::route('index')
			->with('message', trans('fluxbb::login.message_logout'));
	}
	
	public function get_login()
	{
		return View::make('fluxbb::auth.login');
	}

	public function post_login()
	{
		$loginData = array(
			'username'	=> Input::get('req_username'),
			'password'	=> Input::get('req_password'),
		);

		if (Auth::attempt($loginData, Input::has('save_pass')))
		{
			// Make sure last_visit data is properly updated
			//\Session::sweep();
			// TODO: Implement this!

			if (Session::has('redirect_url'))
			{
				$redirectUrl = Session::get('redirect_url');
			}
			else
			{
				$redirectUrl = route('index');
			}

			// FIXME: Redirect to $redirectUrl
			return Redirect::route('index')
				->with('message', 'You were successfully logged in.');
		}
		else
		{
			$errors = new \Illuminate\Support\MessageBag;
			$errors->add('login', 'Invalid username / password combination.');

			return Redirect::route('login')
				->withInput(Input::get())
				->with('errors', $errors);
		}
	}

	public function get_register()
	{
		return View::make('fluxbb::auth.register');
	}

	public function post_register()
	{
        $rules = array(
			'user'		=> 'required|between:2,25|username_not_guest|no_ip|username_not_reserved|no_bbcode|not_censored|unique:users,username|username_not_banned',
		);
		
		// If email confirmation is enabled
		if (Config::enabled('o_regs_verify'))
		{
			$rules['email'] = 'required|email|confirmed|unique:users,email|email_not_banned';
		}
		else
		{
			$rules['password'] = 'required|min:4|confirmed';
			$rules['email'] = 'required|email|unique:users,email';
		}

		// Agree to forum rules
		if (Config::enabled('o_rules'))
		{
			$rules['rules'] = 'accepted';
		}

		$validation = Validator::make(Input::get(), $rules);
		if ($validation->fails())
		{
			return Redirect::route('register')
				->withInput(Input::get())
				->with('errors', $validation->messages());
		}

		$user_data = array(
			'username'			=> Input::get('user'),
			'group_id'			=> Config::get('o_default_user_group'),
			'password'			=> Input::get('password'),
			'email'				=> Input::get('email'),
			'email_setting'		=> Config::get('o_default_email_setting'),
			'timezone'			=> Config::get('o_default_timezone'),
			'dst'				=> Config::get('o_default_dst'),
			'language'			=> Config::get('o_default_lang'),
			'style'				=> Config::get('o_default_style'),
			'registered'		=> Request::server('REQUEST_TIME', time()),
			'registration_ip'	=> Request::getClientIp(),
			'last_visit'		=> Request::server('REQUEST_TIME', time()),
		);
		$user = User::create($user_data);

		// Notify the user about his new account!
		$user->sendWelcomeMail();
	
		return Redirect::route('index')
			->with('message', trans('fluxbb::register.reg_complete'));
	}

}
