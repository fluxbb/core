<?php

namespace FluxBB\Models;

interface CategoryRepositoryInterface
{
    public function findBySlug($slug);

    public function getByParent($slug);

    public function getTopicsIn($category);

    public function addNewTopic($category, $topic, $post);
}
