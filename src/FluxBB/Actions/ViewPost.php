<?php

namespace FluxBB\Actions;

use FluxBB\Core\Action;
use FluxBB\Models\TopicRepositoryInterface;
use FluxBB\Models\User;
use FluxBB\Server\Request;

class ViewPost extends Action
{
    protected $topics;


    public function __construct(TopicRepositoryInterface $repository)
    {
        $this->topics = $repository;
    }

    protected function run()
    {
        $id = $this->request->get('id');

        $post = $this->topics->findPostById($id);
        $page = $this->topics->getPageOfPost($post, User::current()->dispPosts());

        $this->forwardTo(
            new Request('topic', [
                'id' => $post->topic_id,
                'page' => $page,
            ])
        ); // TODO: Append #p to URL
    }
}
