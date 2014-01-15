<?php

namespace FluxBB\Controllers;

use FluxBB\Models\Category,
	FluxBB\Models\Forum,
	FluxBB\Models\Post,
	FluxBB\Models\Topic,
	FluxBB\Models\User;
use App;
use Paginator;
use View;

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
			App::abort(404);
		}

		return View::make('fluxbb::viewforum')->with('forum', $forum);
	}

	public function get_topic($tid, $page = 1)
	{
		// Fetch some info about the topic
		$topic = Topic::find($tid);

		if (is_null($topic))
		{
			App::abort(404);
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
			App::abort(404);
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
