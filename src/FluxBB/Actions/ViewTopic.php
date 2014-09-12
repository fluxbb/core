<?php

namespace FluxBB\Actions;

use FluxBB\Core\Action;
use FluxBB\Models\Topic;

class ViewTopic extends Action
{
    protected function run()
    {
        $tid = $this->request->get('id');

        // Fetch some info about the topic
        $topic = Topic::findOrFail($tid);

        // Make sure post authors and their groups are all loaded
        $topic->posts->load('author.group');

        $this->data['topic'] = $topic;
    }
}
