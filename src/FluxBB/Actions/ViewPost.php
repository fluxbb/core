<?php

namespace FluxBB\Actions;

use FluxBB\Core\Action;
use FluxBB\Models\ConversationRepository;
use FluxBB\Models\User;
use FluxBB\Server\Request;

class ViewPost extends Action
{
    protected $conversations;


    public function __construct(ConversationRepository $repository)
    {
        $this->conversations = $repository;
    }

    protected function run()
    {
        $id = $this->request->get('id');

        $post = $this->conversations->findPostById($id);
        $page = $this->conversations->getPageOfPost($post, User::current()->dispPosts());

        $this->redirectTo(
            new Request('conversation', [
                'id' => $post->conversation_id,
                'page' => $page,
            ])
        ); // TODO: Append #p to URL
    }
}
