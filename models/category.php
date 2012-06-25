<?php namespace fluxbb;

class Category extends \Eloquent {

	public function forums()
	{
		return $this->has_many('fluxbb\\Forum', 'cat_id');
	}

}
