<?php

namespace FluxBB\Actions;

use FluxBB\Core\Action;
use FluxBB\Models\Forum;

class NewTopicPage extends Action
{
    protected function run()
    {
        $fid = $this->request->get('id');

        $forum = Forum::with('perms')->findOrFail($fid);

        $this->data['forum'] = $forum;
    }
}
