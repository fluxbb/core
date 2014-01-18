<?php

namespace FluxBB\Services;

use FluxBB\Models\Post;
use FluxBB\Models\Topic;
use Illuminate\Support\MessageBag;

interface CreateReplyObserver
{

	public function replyCreated(Post $post);
	public function replyValidationFailed(Topic $topic, MessageBag $errors);

}
