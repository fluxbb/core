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
	public function get_login()
	{
		if ($this->user->is_member())
		{
			return Redirect::to_action('fluxbb::home@index');
		}
		
		$redirect_url = URL::to_action('fluxbb::home@index');

		return View::make('fluxbb::auth.login')
			->with('redirect_url', $redirect_url);
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

}
