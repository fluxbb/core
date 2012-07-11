<?php
/**
 * FluxBB - fast, light, user-friendly PHP forum software
 * Copyright (C) 2008-2012 FluxBB.org
 * based on code by Rickard Andersson copyright (C) 2002-2008 PunBB
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public license for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * @category	FluxBB
 * @package		Core
 * @copyright	Copyright (c) 2008-2012 FluxBB (http://fluxbb.org)
 * @license		http://www.gnu.org/licenses/gpl.html	GNU General Public License
 */

use fluxbb\User;

class FluxBB_User_Controller extends FluxBB_BaseController
{

	public function get_profile($id, $action = "essentials")
	{
		$user = User::where_id($id)->first();

		if ($user === NULL)
		{
			return Event::first('404');
		}
		
		else if(User::current()->id == $id || User::current()->group_id == 1) //TODO: Add more specific rule for admins (now it is based on the group_id of the visiting user)
		{
			return View::make("fluxbb::user.profile.".$action)
				->with('user', $user)
				->with('admin', User::current()->group_id == 1);
		}
		
		else
		{
			return View::make("fluxbb::user.profile.view")
				->with('user', $user);
		}
	
	}
	
	public function put_profile($id, $action = "essentials")
	{
		$user = User::where_id($id)->first();
		if ($action == "essentials")
		{
			$user->username = Input::get('username', $user->username);
			$user->email = Input::get('email', $user->email);
			$user->timezone = Input::get('timezone', $user->timezone);
			$user->dst = Input::get('dst', $user->dst);
			$user->time_format = Input::get('time_format');
			$user->date_format = Input::get('date_format');
			$user->admin_note = Input::get('admin_note', $user->admin_note);
		}
		
		else if ($action == "messaging")
		{
			$user->jabber = Input::get('jabber');
			$user->icq = Input::get('icq');
			$user->msn = Input::get('msn');
			$user->aim = Input::get('aim');
			$user->yahoo = Input::get('yahoo');
		}
		
		else if ($action == "personal")
		{
			$user->realname = Input::get('realname');
			$user->title = Input::get('title');
			$user->location = Input::get('location');
			$user->url = Input::get('url');
		}
		
		else if ($action == "personality")
		{
			$user->signature = Input::get('signature');
		}
		
		else if ($action == "display")
		{
		//This will give an error if not everything is set -> need to set defaults in database!
			$user->style = Input::get('style');
			$user->show_smilies = Input::get('show_smilies');
			$user->show_sig = Input::get('show_sig');
			$user->show_avatars = Input::get('show_avatars');
			$user->show_img = Input::get('show_img');
			$user->disp_topics = Input::get('disp_topics', $user->disp_topics);
			$user->disp_posts = Input::get('disp_posts', $user->disp_posts);
		}
		
		else //if action == privacy
		{
			//TODO
		}
		
		$user->save();
		return View::make("fluxbb::user.profile.".$action)
				->with('user', $user)
				->with('admin', (User::current()->group_id == 1));
	}

	public function get_list()
	{
		$users = DB::table('users')->paginate(20);

		return View::make('fluxbb::user.list')
			->with('users', $users);
	}

}