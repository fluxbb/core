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

use FluxBB\Controllers\Base;
use FluxBB\Models\Category,
	FluxBB\Models\Forum,
	FluxBB\Models\Post,
	FluxBB\Models\Topic,
	FluxBB\Models\User;
use Paginator;
use View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Home extends Base
{

	public function get_index()
	{
		// TODO: Get list of forums and topics with new posts since last visit & get all topics that were marked as read

		// Fetch the categories and forums
		$categories = Category::allForGroup(User::current()->group_id);

		$view = View::make('fluxbb::index');
		$view['categories'] = $categories;
		return $view;
	}

	public function get_forum($fid, $page = 1)
	{
		$page = intval($page);

		// Fetch some info about the forum
		$forum = Forum::with('perms')
			->where('id', '=', $fid)
			->first();

		if (is_null($forum))
		{
			throw new NotFoundHttpException;
		}

		$dispTopics = User::current()->dispTopics();
		$numPages = ceil(($forum->num_topics + 1) / $dispTopics);
		$page = ($page <= 1 || $page > $numPages) ? 1 : intval($page);
		$startFrom = $dispTopics * ($page - 1);

		// FIXME: Do we have to fetch just IDs first (performance)?
		// TODO: If logged in, with "the dot" subquery
		// Fetch topic data
		$topics = Topic::where('forum_id', '=', $fid)
			->orderBy('sticky', 'DESC')
			->orderBy($forum->sortColumn(), $forum->sortDirection())
			->orderBy('id', 'DESC')
			->skip($startFrom)
			->take($dispTopics)
			->get();

		return View::make('fluxbb::viewforum')
			->with('forum', $forum)
			->with('topics', $topics)
			->with('start_from', $startFrom);
	}

	public function get_topic($tid, $page = 1)
	{
		// Fetch some info about the topic
		$topic = Topic::with('forum.perms')
			->where('id', '=', $tid)
			->whereNull('moved_to')
			->first();

		if (is_null($topic))
		{
			throw new NotFoundHttpException;
		}

		$dispPosts = User::current()->dispPosts();
		$numPages = ceil(($topic->num_replies + 1) / $dispPosts);
		$page = ($page <= 1 || $page > $numPages) ? 1 : intval($page);
		$startFrom = $dispPosts * ($page - 1);


		// TODO: Use paginate?
		// Fetch post data
		// TODO: Can we enforce the INNER JOIN here somehow?
		$posts = Post::with('author.group')
			->where('topic_id', '=', $tid)
			->orderBy('id')
			->skip($startFrom)
			->take($dispPosts)
			->get();	// TODO: Or do I need to fetch the IDs here first, since those big results will otherwise have to be filtered after fetching by LIMIT / OFFSET?

		return View::make('fluxbb::viewtopic')
			->with('topic', $topic)
			->with('posts', $posts)
			->with('start_from', $startFrom);
	}

	public function get_post($pid)
	{
		// If a post ID is specified we determine topic ID and page number so we can show the correct message
		$post = Post::where('id', '=', $pid)
			->select(array('topic_id', 'posted'))
			->first();

		if (is_null($post))
		{
			throw new NotFoundHttpException;
		}

		$tid = $post->topic_id;
		$posted = $post->posted;

		// Determine on what page the post is located (depending on $forum_user['disp_posts'])
		$numPosts = Post::where('topic_id', '=', $tid)
			->where('posted', '<', $posted)
			->count('id') + 1;

		$dispPosts = User::current()->dispPosts();
		$p = ceil($numPosts / $dispPosts);

		// Tell the paginator which page we're on
		Paginator::setCurrentPage($p);

		// FIXME: second parameter for $page number
		return $this->get_topic($tid);
	}

}
