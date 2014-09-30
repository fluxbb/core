<?php

namespace FluxBB\Models;

use Illuminate\Database\ConnectionInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected $database;


    public function __construct(ConnectionInterface $database)
    {
        $this->database = $database;
    }

    public function save(Category $forum)
    {
        //
    }

    public function findBySlug($slug)
    {
        $row = $this->database->table('categories')->where('slug', $slug)->first();

        return $row;
    }

    public function getByParent($slug)
    {
        return $this->database->table('categories')->where('slug', '!=', $slug)->where('slug', 'LIKE', "$slug%")->get();
    }

    public function getTopicsIn($category)
    {
        $rows = $this->database->table('topics')->where('category_slug', $category->slug)->get();

        return $rows;
    }

    public function addNewTopic($category, $topic, $post)
    {
        $topic->category_slug = $category->slug;
        $topic->id = $this->database->table('topics')->insertGetId((array) $topic);

        $post['topic_id'] = $topic->id;
        $this->database->table('posts')->insertGetId($post);
    }
}
