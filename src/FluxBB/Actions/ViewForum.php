<?php

namespace FluxBB\Actions;

use FluxBB\Core\Action;
use FluxBB\Models\Forum;

class ViewForum extends Action
{
    protected function run()
    {
        $fid = $this->request->get('id');

        // Fetch some info about the topic
        $this->data['forum'] = Forum::findOrFail($fid);
    }
}
