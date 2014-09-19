<?php

namespace FluxBB\Models;

interface ConversationRepositoryInterface
{
    public function findById($id);

    public function getPostsIn($conversation);

    public function findPostById($id);

    public function getPageOfPost($post, $perPage);

    public function addReply($conversation, $post);
}
