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

namespace fluxbb\Models;

use Auth;
use Hash;

class User extends Base
{
	public function group()
	{
		return $this->belongs_to('fluxbb\\Models\\Group');
	}

	public function online()
	{
		return $this->has_one('fluxbb\\Models\\Online');
	}

	public function bans()
	{
		return $this->has_many('fluxbb\\Models\\Ban');
	}

	public function posts()
	{
		return $this->has_many('fluxbb\\Models\\Post', 'poster_id');
	}

	public static function current()
	{
		static $current;

		if (Auth::guest())
		{
			if (!isset($current))
			{
				$current = static::find(1);
			}

			return $current;
		}

		// We already have the logged in user's object
		return Auth::user();
	}

	public function is_guest()
	{
		// FIXME: This should be a constant (was PUN_GUEST or something else) maybe
		return $this->group_id == 3;
	}

	public function is_member()
	{
		return !$this->is_guest();
	}

	// TODO: Better name
	public function is_admmod()
	{
		// TODO: Is this even necessary or is a better check for is_moderator() (that returns true for admins, too) better?
		return $this->is_admin() || $this->is_moderator();
	}

	public function is_admin()
	{
		return $this->group_id = 1;
	}

	public function is_moderator()
	{
		return $this->group->g_moderator == 1;
	}

	public function title()
	{
		static $ban_list;

		// If not already built in a previous call, build an array of lowercase banned usernames
		if (empty($ban_list))
		{
			$ban_list = array();

			// FIXME: Retrieve $bans (former $pun_bans)
			$bans = array();
			foreach ($bans as $cur_ban)
			{
				$ban_list[] = strtolower($cur_ban['username']);
			}
		}

		// If the user has a custom title
		if ($this->title != '')
		{
			return $this->title;
		}
		// If the user is banned
		else if (in_array(strtolower($this->username), $ban_list))
		{
			return __('Banned');
		}
		// If the user group has a default user title
		else if ($this->group->g_user_title != '')
		{
			return $this->group->g_user_title;
		}
		// If the user is a guest
		else if ($this->is_guest())
		{
			return __('Guest');
		}
		// If nothing else helps, we assign the default
		else
		{
			return __('Member');
		}
	}

	public function get_avatar_file()
	{
		// TODO: We might want to cache this result
		$filetypes = array('jpg', 'gif', 'png');

		foreach ($filetypes as $cur_type)
		{
			// FIXME: Prepend base path for upload dir
			$path = '/'.$this->id.'.'.$cur_type;

			if (file_exists($path))
			{
				return $path;
			}
		}

		return '';
	}

	public function has_avatar()
	{
		return (bool) $this->get_avatar_file();
	}

	public function has_signature()
	{
		return !empty($this->signature);
	}

	public function signature()
	{
		// TODO: Actually parse this, but somewhere else (as that's presentation code)
		// see fluxbb\Post::message()
		return $this->signature;
	}

	public function is_online()
	{
		return isset($this->online) && $this->online->user_id == $this->id;
	}

	public function has_url()
	{
		return !empty($this->url);
	}

	public function has_location()
	{
		return !empty($this->location);
	}

	public function has_admin_note()
	{
		return !empty($this->admin_note);
	}

	public function disp_topics()
	{
		return $this->disp_topics ?: Config::get('o_disp_topics_default');
	}

	public function disp_posts()
	{
		return $this->disp_posts ?: Config::get('o_disp_posts_default');
	}

	public function set_password($password)
	{
		$this->set_attribute('password', Hash::make($password));
		// TODO: Maybe reset some attributes like confirmation code here?
	}

}
