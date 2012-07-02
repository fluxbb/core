<?php namespace fluxbb;

class Ban extends \FluxBB_BaseModel
{

	public function creator()
	{
		return $this->belongs_to('fluxbb\\User', 'ban_creator');
	}

}
