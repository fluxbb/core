<?php

namespace FluxBB\Models;

use Illuminate\Database\ConnectionInterface;

class TopicRepository implements TopicRepositoryInterface
{
    protected $database;


    public function __construct(ConnectionInterface $database)
    {
        $this->database = $database;
    }

    public function findById($id)
    {
        $row = $this->database->table('topics')->where('id', $id)->first();

        return $row;
    }

    public function getPostsIn($topic)
    {
        $rows = $this->database->table('posts')->where('topic_id', $topic->id)->get();

        return $rows;
    }

    public function findPostById($id)
    {
        return $this->database->table('posts')->where('id', $id)->first();
    }

    public function getPageOfPost($post, $perPage)
    {
        $numPosts = $this->database->table('posts')->where('topic_id', $post->topic_id)
                                                   ->where('posted', '<', $post->posted)
                                                   ->count('id') + 1;

        return ceil($numPosts / $perPage);
    }

    public function addReply($topic, $post)
    {
        $post->topic_id = $topic->id;
        $post->id = $this->database->table('posts')->insertGetId($post->toArray());
    }
}
