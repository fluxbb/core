<?php namespace fluxbb;

class Group extends \FluxBB_BaseModel
{
	public static $key = 'g_id';

	public function users()
	{
		return $this->has_many('fluxbb\\User');
	}

}
