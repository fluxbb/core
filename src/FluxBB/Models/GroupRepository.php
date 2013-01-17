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

use Illuminate\Cache\CacheManager;
use Illuminate\Database\Eloquent\Collection;

class GroupRepository implements GroupRepositoryInterface
{

	protected $cache;

	protected $retrieved = array();

	public function __construct(CacheManager $cache)
	{
		$this->cache = $cache;
	}

	public function getHierarchy()
	{
		return Group::whereNull('parent_id')
		            ->orderBy('id')
		            ->get();
	}

	public function find($id)
	{
		return $this->retrieve($id);
	}

	protected function retrieve($id)
	{
		if (!isset($this->retrieved[$id]))
		{
			$this->retrieved[$id] = $group = Group::find($id);

			$this->loadPermissions($group);
		}

		return $this->retrieved[$id];
	}

	protected function loadPermissions($group)
	{
		if ($this->hasCachedPermissions($group->id))
		{
			$permissions = $this->getCachedPermissions($group);
		}
		else
		{
			$permissions = $this->cachePermissions($group);
		}

		$collection = new Collection($permissions);
		$group->setRelation('permissions', $collection);
	}

	protected function hasCachedPermissions($id)
	{
		return $this->cache->has('fluxbb.group.permissions.'.$id);
	}

	protected function cachePermissions($group)
	{
		$permissions = array();

		// Overwrite parent permissions if those are set
		if ($group->parent_id)
		{
			$permissions = $this->cachePermissions($group->parent);
		}

		$permissions = array_unique(array_merge($permissions, $group->permissions()->get()->all()));

		// Cache for 14 days
		$this->cache->put('fluxbb.group.permissions.'.$group->id, $permissions, 20160);

		return $permissions;
	}

	protected function getCachedPermissions($group)
	{
		return $this->cache->get('fluxbb.group.permissions.'.$group->id);
	}

}
