<?php

namespace FluxBB\Actions;

use Symfony\Component\HttpFoundation\Request;
use FluxBB\Models\Topic;

class ReplyPage extends Page
{
    protected $viewName = 'fluxbb::posting.post';


    protected function handleRequest(Request $request)
    {
        $tid = \Route::input('id');

        // Fetch some info about the topic
        $topic = Topic::with('forum.perms')->findOrFail($tid);

        $this->data['topic'] = $topic;
        $this->data['action'] = trans('fluxbb::post.post_a_reply');
    }
}
