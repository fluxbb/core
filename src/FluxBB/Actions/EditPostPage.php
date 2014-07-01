<?php

namespace FluxBB\Actions;

use Symfony\Component\HttpFoundation\Request;
use FluxBB\Models\Post;

class EditPostPage extends Page
{
    protected $viewName = 'fluxbb::posting.post';


    protected function handleRequest(Request $request)
    {
        $pid = \Route::input('id');

        // Fetch some info about the topic
        $topic = Post::with('author', 'topic')->findOrFail($pid);

        $this->data['post'] = $post;
        $this->data['action'] = trans('fluxbb::forum.edit_post');
    }
}
