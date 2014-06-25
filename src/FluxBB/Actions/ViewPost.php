<?php

namespace FluxBB\Actions;

use FluxBB\Models\Post;
use FluxBB\Models\User;
use Symfony\Component\HttpFoundation\Request;

class ViewPost extends Base
{
    protected $post;

    protected $page;


    protected function handleRequest(Request $request)
    {
        // TODO: Fetch from request
        $pid = 1;

        // If a post ID is specified we determine topic ID and page number so we can show the correct message
        $this->post = Post::findOrFail($pid);

        // Determine on which page the post is located
        $numPosts = Post::where('topic_id', '=', $this->post->topic_id)
                ->where('posted', '<', $this->post->posted)
                ->count('id') + 1;

        $dispPosts = User::current()->dispPosts();
        $this->page = ceil($numPosts / $dispPosts);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    protected function makeResponse()
    {
        $url = route('viewtopic', [
            'id' => $this->post->topic_id,
            'page' => $this->page
        ]).'#p'.$this->post->topic_id;
        return $this->redirectTo($url);
    }
}
