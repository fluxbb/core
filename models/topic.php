<?php namespace fluxbb;

class Topic extends \Eloquent {

	public function posts()
	{
		return $this->has_many('fluxbb\\Post');
	}

}
