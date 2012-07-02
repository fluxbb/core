<?php namespace fluxbb;

class Category extends \FluxBB_BaseModel
{

	public function forums()
	{
		return $this->has_many('fluxbb\\Forum', 'cat_id');
	}

}
