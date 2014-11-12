<?php

namespace FluxBB\Models;

use FluxBB\Server\Exception\Exception;
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

        if (is_null($row)) {
            throw new Exception('Category does not exist.');
        }

        return $row;
    }

    public function getByParent($slug)
    {
        return $this->database->table('categories')->where('slug', '!=', $slug)->where('slug', 'LIKE', "$slug%")->get();
    }

    public function getConversationsIn($category)
    {
        if (is_null($category)) {
            return [];
        }

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
