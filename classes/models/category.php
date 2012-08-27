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

use \Cache;

class Category extends Base
{

	public function forums()
	{
		return $this->has_many('fluxbb\\Models\\Forum', 'cat_id')
			->order_by('disp_position', 'ASC');
	}

	public static function all_for_group($group_id)
	{
		return Cache::remember('fluxbb.forums-group'.$group_id, function() use($group_id) {
			return Category::with(array(
				'forums',
				'forums.perms' => function($query) use($group_id) {
					$query->where_group_id($group_id)
						->where_null('read_forum')
						->or_where('read_forum', '=', '1');
				},
			))
			->order_by('disp_position', 'ASC')
			->order_by('id', 'ASC')
			->get();
		}, 24 * 60);
	}

}
