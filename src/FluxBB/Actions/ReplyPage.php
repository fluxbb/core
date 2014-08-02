<?php

namespace FluxBB\Actions;

use FluxBB\Models\Topic;

class ReplyPage extends Base
{
    protected function run()
    {
        $tid = $this->request->get('id');

        // Fetch some info about the topic
        $topic = Topic::with('forum.perms')->findOrFail($tid);

        $this->data['topic'] = $topic;
        $this->data['action'] = trans('fluxbb::post.post_a_reply');
    }
}
