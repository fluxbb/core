<?php

namespace FluxBB\Actions;

use FluxBB\Core\Action;
use FluxBB\Models\ConversationRepository;

class ViewConversation extends Action
{
    protected $conversations;


    public function __construct(ConversationRepository $repository)
    {
        $this->conversations = $repository;
    }

    protected function run()
    {
        $id = $this->request->get('id');

        $conversation = $this->conversations->findById($id);

        $this->data['conversation'] = $conversation;
        $this->data['posts'] = $this->conversations->getPostsIn($conversation);
    }
}
