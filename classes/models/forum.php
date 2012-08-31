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

use Laravel\Cache;

class Forum extends Base
{

	public function topics()
	{
		return $this->has_many('fluxbb\\Models\\Topic');
	}

	public function subscriptions()
	{
		return $this->has_many('fluxbb\\Models\\ForumSubscription');
	}

	public function subscription()
	{
		return $this->has_one('fluxbb\\Models\\ForumSubscription')
			->where_user_id(User::current()->id);
	}

	public function perms()
	{
		// TODO: has_one() with group condition?
		return $this->has_many('fluxbb\\Models\\ForumPerms')
			->where_group_id(User::current()->id)
			->where_null('read_forum')
			->or_where('read_forum', '=', '1');
	}


	public static function ids()
	{
		return Cache::remember('fluxbb.forum_ids', function() {
			return Forum::lists('id');
		}, 7 * 24 * 60);
	}

	public static function all_for_group($group_id)
	{
		$ids = ForumPerms::forums_for_group($group_id);

		return static::where_in('id', $ids)->get();
	}

	public function num_topics()
	{
		return $this->redirect_url == '' ? $this->num_topics : '-';
	}

	public function num_posts()
	{
		return $this->redirect_url == '' ? $this->num_posts : '-';
	}

	public function is_user_subscribed()
	{
		return \Auth::check() && !is_null($this->subscription);
	}

	public function moderators()
	{
		return $this->moderators != '' ? unserialize($this->moderators) : array();
	}

	public function is_moderator()
	{
		return User::current()->is_moderator() && array_key_exists(User::current()->username, $this->moderators());
	}

	public function is_admmod()
	{
		return User::current()->is_admin() || $this->is_moderator();
	}

	public function sort_column()
	{
		switch ($this->sort_by)
		{
			case 0:
				return 'last_post';
			case 1:
				return 'posted';
			case 2:
				return 'subject';
			default:
				return 'last_post';
		}
	}

	public function sort_direction()
	{
		switch ($this->sort_by)
		{
			case 0:
				return 'DESC';
			case 1:
				return 'DESC';
			case 2:
				return 'ASC';
			default:
				return 'DESC';
		}
	}

	public function subscribe($subscribe = true)
	{
		// To subscribe or not to subscribe, that ...
		if (!Config::enabled('o_forum_subscriptions') || !Auth::check())
		{
			return false;
		}

		if ($subscribe && !$this->is_user_subscribed())
		{
			$this->subscription()->insert(array('user_id' => User::current()->id));
		}
		else if (!$subscribe && $this->is_user_subscribed())
		{
			$this->subscription()->delete();
		}
	}

	public function unsubscribe()
	{
		return $this->subscribe(false);
	}
	
}
