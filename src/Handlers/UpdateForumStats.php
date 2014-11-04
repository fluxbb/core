<?php

namespace FluxBB\Handlers;

use FluxBB\Core\EventHandler;
use FluxBB\Events\UserHasPosted;

class UpdateForumStats extends EventHandler
{
    public function whenUserHasPosted(UserHasPosted $event)
    {
        $post = $event->post;

        $topic = $post->topic;
        $topic->last_post_id = $post->id;
        $topic->num_replies += 1;
        $topic->save();

        $forum = $topic->forum;
        $forum->num_posts += 1;
        $forum->last_post = $topic->last_post;
        $forum->last_post_id = $topic->last_post_id;
        $forum->last_poster = $topic->last_poster;
        $forum->save();
    }
}
