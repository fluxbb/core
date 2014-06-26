<?php

namespace FluxBB\Actions;

use Symfony\Component\HttpFoundation\Request;
use FluxBB\Models\Topic;

class ViewTopic extends Page
{
    protected $viewName = 'fluxbb::viewtopic';


    protected function handleRequest(Request $request)
    {
        $tid = \Route::input('id');

        // Fetch some info about the topic
        $topic = Topic::findOrFail($tid);

        // Make sure post authors and their groups are all loaded
        $topic->posts->load('author.group');

        $this->data['topic'] = $topic;
    }
}
