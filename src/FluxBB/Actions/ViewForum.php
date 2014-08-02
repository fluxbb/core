<?php

namespace FluxBB\Actions;

use FluxBB\Models\Forum;

class ViewForum extends Base
{
    protected function run()
    {
        $fid = $this->request->get('id');

        // Fetch some info about the topic
        $this->data['forum'] = Forum::findOrFail($fid);
    }
}
