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

    public function getPostsIn($conversation)
    {
        $rows = $this->database->table('posts')->where('conversation_id', $conversation->id)->get();

        return $rows;
    }

    public function addReply($conversation, $post)
    {
        $post->conversation_id = $conversation->id;
        $post->id = $this->database->table('posts')->insertGetId($post->toArray());
    }

    public function findPostById($id)
    {
        return $this->database->table('posts')->where('id', $id)->first();
    }

    public function getPageOfPost($post, $perPage)
    {
        $numPosts = $this->database->table('posts')->where('conversation_id', $post->conversation_id)
                                                   ->where('posted', '<', $post->posted)
                                                   ->count('id') + 1;

        return ceil($numPosts / $perPage);

    }
}
