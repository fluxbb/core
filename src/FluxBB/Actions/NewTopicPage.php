<?php

namespace FluxBB\Actions;

use FluxBB\Models\Forum;

class NewTopicPage extends Base
{
    protected function run()
    {
        $fid = $this->request->get('id');

        $forum = Forum::with('perms')->findOrFail($fid);

        $this->data['forum'] = $forum;
        $this->data['action'] = trans('fluxbb::forum.post_topic');
    }
}
