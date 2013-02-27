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
		if ($this->cache->has('fluxbb.groups.hierarchy'))
		{
			return $this->cache->get('fluxbb.groups.hierarchy');
		}

		$allGroups = Group::orderBy('id')->get()->all();

		$keyedGroups = array();
		foreach ($allGroups as $group)
		{
			$keyedGroups[$group->id] = $group;
		}

		// Collect root groups and groups with parent by key
		$rootGroups = $groupsByParent = array();
		foreach ($keyedGroups as $key => $group)
		{
			if ($group->hasParent())
			{
				$groupsByParent[$group->parent_group_id][] = $group;
			}
			else
			{
				$rootGroups[] = $group;
			}
		}

		// Now set up the children relationships for all leftover groups
		foreach ($groupsByParent as $parentGroupId => $subgroups)
		{
			$collection = new Collection($subgroups);
			$keyedGroups[$parentGroupId]->setRelation('children', $collection);
		}

		// Cache for 14 days
		$this->cache->put('fluxbb.groups.hierarchy', $rootGroups, 20160);

		return $rootGroups;
	}

	public function find($id)
	{
		return $this->retrieve($id);
	}

	public function delete(Group $group)
	{
		$this->clearCache();
		$this->deletePermissions($group);

		// TODO: Handle child groups!
		return $group->delete();
	}

	protected function retrieve($id)
	{
		if (!isset($this->retrieved[$id]))
		{
			$this->retrieved[$id] = $group = Group::find($id);

			if (is_null($group))
			{
				return;
			}

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

	protected function cachePermissions(Group $group)
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

	protected function getCachedPermissions(Group $group)
	{
		return $this->cache->get('fluxbb.group.permissions.'.$group->id);
	}

	protected function deletePermissions(Group $group)
	{
		GroupPermission::where('group_id', $group->id)->delete();

		$this->cache->forget('fluxbb.group.permissions.'.$group->id);		
	}

	protected function clearCache()
	{
		$this->cache->forget('fluxbb.groups.hierarchy');
	}

}
