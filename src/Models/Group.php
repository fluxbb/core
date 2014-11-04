<?php

namespace FluxBB\Models;

class Group extends Base
{
    protected $table = 'groups';

    protected $fillable = array('name', 'parent_group_id');

    const ADMIN 	= 1;

    const MOD 		= 2;

    const MEMBER 	= 3;

    public function users()
    {
        return $this->hasMany('FluxBB\Models\User');
    }

    public function parent()
    {
        return $this->belongsTo('FluxBB\Models\Group', 'parent_group_id');
    }

    public function children()
    {
        return $this->hasMany('FluxBB\Models\Group', 'parent_group_id');
    }

    public function permissions()
    {
        return $this->hasMany('FluxBB\Models\GroupPermission');
    }


    public function hasParent()
    {
        return !is_null($this->parent_group_id);
    }

    public function isAdmin()
    {
        return true;
    }
}
