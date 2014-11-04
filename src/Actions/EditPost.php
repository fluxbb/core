<?php

namespace FluxBB\Actions;

use Carbon\Carbon;
use FluxBB\Core\Action;
use FluxBB\Events\PostWasEdited;
use FluxBB\Models\User;
use FluxBB\Models\Post;

class EditPost extends Action
{
    protected function run()
    {
        $pid = $this->get('id');
        $post = Post::with('author', 'topic')->findOrFail($pid);

        $creator = User::current();
        $post->fill([
            'message'   => $this->get('message'),
            'edited'    => Carbon::now(),
            'edited_by' => $creator->username,
        ]);

        $post->save();
        $this->raise(new PostWasEdited($post, $creator));

        return [
            'post' => $post,
        ];
    }
}
