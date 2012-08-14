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

use fluxbb\Controllers\Base,
	fluxbb\Models\Post,
	fluxbb\Models\Topic,
	fluxbb\Models\User;

class FluxBB_Posting_Controller extends Base
{

	public function get_reply($tid)
	{
		$topic = Topic::where_id($tid)->first();

		if ($topic === NULL)
		{
			return Event::first('404');
		}

		return View::make("fluxbb::posting.post")
			->with('topic', $topic)
			->with('action', __('fluxbb::post.new_reply'));
	}

	// TODO:
	public function put_reply($tid)
	{
		// TODO: guest
		$username = User::current()->username;

		$post_data = array(
			'poster'			=> $username,
			'poster_id'			=> User::current()->id,
		);
		$post = Post::create($post_data);

		return Redirect::to_action('fluxbb::post', array($post->id))->with('message', __('fluxbb::post.post_added'));
	}

}
