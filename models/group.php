<?php namespace fluxbb;

class Group extends \FluxBB_BaseModel {

	public function users()
	{
		return $this->has_many('fluxbb\\User');
	}

}
