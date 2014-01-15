<?php

namespace FluxBB\Models;

class GroupPermission extends Base
{

	protected $table = 'group_permissions';


	public function group()
	{
		return $this->belongsTo('FluxBB\Models\Group', 'group_id');
	}

}
