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

class ForumPerms extends Base
{

	public static $table = 'forum_perms';


	public function forum()
	{
		return $this->belongs_to('fluxbb\\Models\\Forum', 'forum_id');
	}

	public function group()
	{
		return $this->belongs_to('fluxbb\\Models\\Group', 'group_id');
	}


	public static function forums_for_group($group_id)
	{
		return Cache::remember('fluxbb.forums_for_group.'.$group_id, function() use($group_id) {
			$disallowed = ForumPerms::where_group_id($group_id)->where_read_forum(0)->lists('forum_id');
			$all_forum_ids = Forum::ids();
			return array_diff($all_forum_ids, $disallowed);
		}, 7 * 24 * 60);
	}

}
