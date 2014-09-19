<?php

namespace FluxBB\Models;

use Illuminate\Database\ConnectionInterface;

class CategoryRepository
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

    public function getConversationsIn($category)
    {
        $rows = $this->database->table('conversations')->where('category_slug', $category->slug)->get();

        return $rows;
    }

    public function addNewTopic($category, $conversation, $post)
    {
        $conversation->category_slug = $category->slug;
        $conversation->id = $this->database->table('conversations')->insertGetId((array) $conversation);

        $post['conversation_id'] = $conversation->id;
        $this->database->table('posts')->insertGetId($post);
    }
}
