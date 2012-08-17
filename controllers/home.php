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
	fluxbb\Models\Category,
	fluxbb\Models\Forum,
	fluxbb\Models\Post,
	fluxbb\Models\Topic;

class FluxBB_Home_Controller extends Base
{
	public function get_index()
	{
		// TODO: Get list of forums and topics with new posts since last visit & get all topics that were marked as read

		// Fetch the categories and forums
		$categories = Category::with(array(
			'forums',
			'forums.perms',
		))
		->order_by('disp_position', 'ASC')
		->order_by('id', 'ASC')
		->get();

		return View::make('fluxbb::index')->with('categories', $categories);
	}

	public function get_forum($fid, $page = 1)
	{
		$page = intval($page);

		// Fetch some info about the forum
		$forum = Forum::with('perms')
			->where_id($fid)
			->first();

		if ($forum === NULL)
		{
			return Event::first('404');
		}

		// FIXME: Do we have to fetch just IDs first (performance)?
		// TODO: If logged in, with "the dot" subquery
		// Fetch topic data
		$topics = Topic::where_forum_id($fid)
		->order_by('sticky', 'DESC') // TODO: insert $sort_by
		->order_by('id', 'DESC')
		->paginate($this->user()->disp_topics());

		return View::make('fluxbb::viewforum')
			->with('forum', $forum)
			->with('topics', $topics);
	}

	public function get_topic($tid, $page = 1)
	{
		// Fetch some info about the topic
		$topic = Topic::with(array(
			'forum',
			'forum.perms',
		))
		->where_id($tid)
		->where_null('moved_to')
		->first();

		if ($topic === NULL)
		{
			return Event::first('404');
		}

		$disp_posts = $this->user()->disp_posts();
		$num_pages = ceil(($topic->num_replies + 1) / $disp_posts);
		$page = ($page <= 1 || $page > $num_pages) ? 1 : intval($page);
		$start_from = $disp_posts * ($page - 1);


		// TODO: Use paginate?
		// Fetch post data
		// TODO: Can we enforce the INNER JOIN here somehow?
		$posts = Post::with(array(
			'poster',
			'poster.group',
			'poster.online' => function($query)
			{
				$query->where('user_id', '!=', 1)
					->where_idle(0);
			},
		))
		->where_topic_id($tid)
		->order_by('id')
		->paginate($this->user()->disp_posts());	// TODO: Or do I need to fetch the IDs here first, since those big results will otherwise have to be filtered after fetching by LIMIT / OFFSET?

		return View::make('fluxbb::viewtopic')
			->with('topic', $topic)
			->with('posts', $posts);
	}

	public function get_post($pid)
	{
		// If a post ID is specified we determine topic ID and page number so we can show the correct message
		$post = Post::where_id($pid)->select(array('topic_id', 'posted'))->first();

		if ($post === NULL)
		{
			return Event::first('404');
		}

		$tid = $post->topic_id;
		$posted = $post->posted;

		// Determine on what page the post is located (depending on $forum_user['disp_posts'])
		$num_posts = Post::where_topic_id($tid)->where('posted', '<', $posted)->count('id') + 1;

		$disp_posts = $this->user()->disp_posts();
		$p = ceil($num_posts / $disp_posts);

		// FIXME: second parameter for $page number
		return $this->get_topic($tid);
	}

}
