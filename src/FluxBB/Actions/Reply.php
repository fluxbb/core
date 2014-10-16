<?php

namespace FluxBB\Actions;

use Carbon\Carbon;
use FluxBB\Core\Action;
use FluxBB\Events\UserHasPosted;
use FluxBB\Models\ConversationRepositoryInterface;
use FluxBB\Models\User;
use FluxBB\Models\Post;

class Reply extends Action
{
    protected $conversations;


    public function __construct(ConversationRepositoryInterface $repository)
    {
        $this->conversations = $repository;
    }

    /**
     * Run the action and return a response for the user.
     *
     * @return void
     */
    protected function run()
    {
        $id = $this->get('id');
        $conversation = $this->conversations->findById($id);

        $creator = User::current();

        $post = new Post([
            'poster'    => $creator->username,
            'poster_id' => $creator->id,
            'message'   => $this->get('message'),
            'posted'    => Carbon::now(),
        ]);

        $this->conversations->addReply($conversation, $post);

        $this->raise(new UserHasPosted($creator, $post));
    }
}
