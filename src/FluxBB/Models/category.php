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

namespace FluxBB\Models;

use Laravel\Cache;

class Category extends Base
{

	public function forums()
	{
		return $this->has_many('FluxBB\\Models\\Forum', 'cat_id')
			->order_by('disp_position', 'ASC');
	}


	public static function all()
	{
		return Cache::remember('fluxbb.categories', function() {
			$all = array();
			$categories = Category::order_by('disp_position', 'ASC')
				->order_by('id', 'ASC')
				->get();

			foreach ($categories as $category)
			{
				$all[$category->id] = $category;
			}
			return $all;
		}, 7 * 24 * 60);
	}

	public static function all_for_group($group_id)
	{
		$categories = static::all();

		$forums = Forum::all_for_group($group_id);
		usort($forums, function($forum1, $forum2) {
			if ($forum1->cat_id == $forum2->cat_id)
			{
				// Same category: forum's disp_position value decides
				return $forum1->disp_position - $forum2->disp_position;
			}
			else
			{
				// ...else the categories' disp_position values are compared
				return $categories[$forum1->cat_id]->disp_position - $categories[$forum2->cat_id]->disp_position;
			}
		});
		
		// FIXME: Yuck!!!
		$forums_by_cat = array();
		foreach ($forums as $forum)
		{
			if (!isset($forums_by_cat[$forum->cat_id]))
			{
				$forums_by_cat[$forum->cat_id] = array(
					'category'	=> $categories[$forum->cat_id],
					'forums'	=> array(),
				);
			}

			$forums_by_cat[$forum->cat_id]['forums'][] = $forum;
		}

		return $forums_by_cat;
	}

}
