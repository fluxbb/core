<?php

namespace FluxBB\Models;

interface TopicRepositoryInterface
{
    public function findById($id);

    public function getPostsIn($topic);

    public function findPostById($id);

    public function getPageOfPost($post, $perPage);

    public function addReply($topic, $post);
}
