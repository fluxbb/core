<?php namespace fluxbb;

class Forum extends \FluxBB_BaseModel {

	public function topics()
	{
		return $this->has_many('fluxbb\\Topic');
	}

}
