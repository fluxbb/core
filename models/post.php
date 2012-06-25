<?php namespace fluxbb;

class Post extends \FluxBB_BaseModel {

	public function topic()
	{
		return $this->belongs_to('fluxbb\\Topic');
	}

	public function poster()
	{
		return $this->belongs_to('fluxbb\\User', 'poster_id');
	}

}
