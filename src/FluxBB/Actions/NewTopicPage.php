<?php

namespace FluxBB\Actions;

use Symfony\Component\HttpFoundation\Request;
use FluxBB\Models\Forum;

class NewTopicPage extends Page
{
    protected $viewName = 'fluxbb::posting.post';


    protected function handleRequest(Request $request)
    {
        $fid = \Route::input('id');

        $forum = Forum::with('perms')->findOrFail($fid);

        $this->data['forum'] = $forum;
        $this->data['action'] = trans('fluxbb::forum.post_topic');
    }
}
