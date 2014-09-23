<?php

namespace FluxBB\Actions;

use FluxBB\Core\Action;
use FluxBB\Models\ConversationRepositoryInterface;
use FluxBB\Models\User;
use FluxBB\Server\Request;

class ViewPost extends Action
{
    protected $conversations;


    public function __construct(ConversationRepositoryInterface $repository)
    {
        $this->conversations = $repository;
    }

    protected function run()
    {
        $id = $this->request->get('id');

        $post = $this->conversations->findPostById($id);
        $page = $this->conversations->getPageOfPost($post, User::current()->dispPosts());

        $this->forwardTo(
            new Request('conversation', [
                'id' => $post->conversation_id,
                'page' => $page,
            ])
        ); // TODO: Append #p to URL
    }
}
