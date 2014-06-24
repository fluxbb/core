<?php

namespace FluxBB\Controllers;

use FluxBB\Models\Category;
use FluxBB\Models\Post;
use FluxBB\Models\Topic;
use FluxBB\Models\User;
use App;
use Paginator;
use View;

class HomeController extends BaseController
{
    public function getIndex()
    {
        // TODO: Get list of forums and topics with new posts since last visit & get all topics that were marked as read

        // Fetch the categories and forums
        $categories = Category::allForGroup(User::current()->group_id);

        return View::make('fluxbb::index')->with('categories', $categories);
    }

    public function getPost($pid)
    {
        // If a post ID is specified we determine topic ID and page number so we can show the correct message
        $post = Post::find($pid);

        if (is_null($post)) {
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

        return $this->getTopic($post->topic_id);
    }
}
