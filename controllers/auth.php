<?php

use fluxbb\User;

class FluxBB_Auth_Controller extends FluxBB_BaseController
{
	public function get_login()
	{
		if ($this->user->is_member())
		{
			return Redirect::to_action('fluxbb::home@index');
		}
		
		$redirect_url = URL::to_action('fluxbb::home@index');

		return View::make('fluxbb::auth.login')
			->with('redirect_url', $redirect_url);
	}

}
