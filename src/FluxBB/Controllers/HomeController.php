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

namespace FluxBB\Controllers;

use FluxBB\Models\Category,
	FluxBB\Models\Forum,
	FluxBB\Models\Post,
	FluxBB\Models\Topic,
	FluxBB\Models\User;
use Paginator;
use View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HomeController extends BaseController
{

	public function get_index()
	{
		// TODO: Get list of forums and topics with new posts since last visit & get all topics that were marked as read

		// Fetch the categories and forums
		$categories = Category::allForGroup(User::current()->group_id);

		return View::make('fluxbb::index')->with('categories', $categories);
	}

	public function get_forum($fid)
	{
		// Fetch some info about the forum
		$forum = Forum::find($fid);

		if (is_null($forum))
		{
			throw new NotFoundHttpException;
		}

		return View::make('fluxbb::viewforum')->with('forum', $forum);
	}

	public function get_topic($tid, $page = 1)
	{
		// Fetch some info about the topic
		$topic = Topic::find($tid);

		if (is_null($topic))
		{
			throw new NotFoundHttpException;
		}

		// Make sure post authors and their groups are all loaded
		$topic->posts->load('author.group');

		return View::make('fluxbb::viewtopic')->with('topic', $topic);
	}

	public function get_post($pid)
	{
		// If a post ID is specified we determine topic ID and page number so we can show the correct message
		$post = Post::find($pid);

		if (is_null($post))
		{
			throw new NotFoundHttpException;
		}

		// Determine on which page the post is located
		$numPosts = Post::where('topic_id', '=', $post->topic_id)
		                ->where('posted', '<', $post->posted)
		                ->count('id') + 1;

		$dispPosts = User::current()->dispPosts();
		$page = ceil($numPosts / $dispPosts);

		// Tell the paginator which page we're on
		Paginator::setCurrentPage($page);

		return $this->get_topic($post->topic_id);
	}

}
