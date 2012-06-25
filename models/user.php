<?php namespace fluxbb;

class User extends \FluxBB_BaseModel {

	public function group()
	{
		return $this->belongs_to('fluxbb\\Group');
	}

	public function bans()
	{
		return $this->has_many('fluxbb\\Ban');
	}

	public function posts()
	{
		return $this->has_many('fluxbb\\Post', 'poster_id');
	}

}
