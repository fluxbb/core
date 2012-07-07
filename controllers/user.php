<?php
use fluxbb\User;

class FluxBB_User_Controller extends FluxBB_BaseController
{

	public function get_profile($id)
	{
		$user = User::where_id($id)->first();

		if ($user === NULL)
		{
			return Event::first('404');
		}
		else
		{
			return View::make('fluxbb::user.profile.view')
				->with('user', $user);
		}
	}

	public function get_list()
	{
		$users = DB::table('users')->paginate(20);

		return View::make('fluxbb::user.list')
			->with('users', $users);
	}

}