<?php

namespace FluxBB\Actions;

use FluxBB\Core\Action;
use FluxBB\Models\ConversationRepositoryInterface;

class ViewConversation extends Action
{
    protected $conversations;


    public function __construct(ConversationRepositoryInterface $repository)
    {
        $this->conversations = $repository;
    }

    protected function run()
    {
        $id = $this->get('id');

        $conversation = $this->conversations->findById($id);

        return [
            'conversation' => $conversation,
            'posts'        => $this->conversations->getPostsIn($conversation),
        ];
    }
}
