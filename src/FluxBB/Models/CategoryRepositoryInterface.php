<?php

namespace FluxBB\Models;

interface CategoryRepositoryInterface
{
    public function findBySlug($slug);

    public function getByParent($slug);

    public function getConversationsIn($category);

    public function addNewTopic($category, $conversation, $post);
}
