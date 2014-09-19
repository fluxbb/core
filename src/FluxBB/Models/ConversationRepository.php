<?php

namespace FluxBB\Models;

use Illuminate\Database\ConnectionInterface;

class ConversationRepository
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

    public function findById($id)
    {
        $row = $this->database->table('conversations')->where('id', $id)->first();

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
}
