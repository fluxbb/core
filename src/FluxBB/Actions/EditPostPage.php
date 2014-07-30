<?php

namespace FluxBB\Actions;

use FluxBB\Models\Post;

class EditPostPage extends Page
{
    protected $viewName = 'fluxbb::posting.post';


    protected function run()
    {
        $pid = $this->request->get('id');

        // Fetch some info about the topic
        $post = Post::with('author', 'topic')->findOrFail($pid);

        $this->data['post'] = $post;
        $this->data['action'] = trans('fluxbb::forum.edit_post');
    }
}
