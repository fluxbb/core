<?php

namespace FluxBB\Actions;

use FluxBB\Core\Action;
use FluxBB\Models\ConversationRepositoryInterface;
use FluxBB\Models\User;

class GetPost extends Action
{
    protected $conversations;


    public function __construct(ConversationRepositoryInterface $repository)
    {
        $this->conversations = $repository;
    }

    protected function run()
    {
        $id = $this->get('id');

        $post = $this->conversations->findPostById($id);
        $page = $this->conversations->getPageOfPost($post, User::current()->dispPosts());

        return [
            'post' => $post,
            'page' => $page,
        ];
    }
}
