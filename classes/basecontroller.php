<?php

use fluxbb\User;

class FluxBB_BaseController extends Base_Controller
{
	public $restful = true;

	public function user()
	{
		return User::current();
	}

}
