<?php

namespace FluxBB\Actions;

use FluxBB\Models\Forum;

class ViewForum extends Page
{
    protected $viewName = 'fluxbb::viewforum';


    protected function run()
    {
        $fid = $this->request->get('id');

        // Fetch some info about the topic
        $this->data['forum'] = Forum::findOrFail($fid);
    }
}
