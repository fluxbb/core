<?php

namespace FluxBB\Services;

use FluxBB\Models\Post;
use Illuminate\Support\MessageBag;

interface CreateReplyObserver
{
    public function replyCreated(Post $post);
    public function replyValidationFailed(Post $post, MessageBag $errors);
}
