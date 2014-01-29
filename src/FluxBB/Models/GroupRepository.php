<?php

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
