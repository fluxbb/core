<?php

namespace FluxBB\Services;

use Carbon\Carbon;
use FluxBB\Models\Post;
use FluxBB\Models\Topic;
use FluxBB\Models\User;
use FluxBB\Repositories\Topics;

class CreateReply
{

    protected $observer;

    protected $topics;


    public function __construct(CreateReplyObserver $observer, Topics $topics)
    {
        $this->observer = $observer;
        $this->topics = $topics;
    }

    public function createReply(Topic $topic, User $creator, $message)
    {
        $post = new Post(array(
            'poster'	=> $user->username,
            'poster_id'	=> $user->id,
            'message'	=> $message,
            'posted'	=> Carbon::now(),
        ));

        if ($post->invalid())
        {
            return $this->observer->replyValidationFailed($post, $post->getErrors());
        }

        $topic->addReply($post);
        $post->save();

        $creator->last_posted = Carbon::now();
        $creator->num_posts += 1;
        $creator->save();

        return $this->observer->replyCreated($post);
    }

}
