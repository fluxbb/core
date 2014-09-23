<?php

namespace FluxBB\Actions;

use Carbon\Carbon;
use FluxBB\Core\Action;
use FluxBB\Models\ConversationRepositoryInterface;
use FluxBB\Validator\PostValidator;
use FluxBB\Server\Request;
use FluxBB\Models\User;
use FluxBB\Models\Post;

class Reply extends Action
{
    protected $validator;

    protected $conversations;


    public function __construct(PostValidator $validator, ConversationRepositoryInterface $repository)
    {
        $this->validator = $validator;
        $this->conversations = $repository;
    }

    /**
     * Run the action and return a response for the user.
     *
     * @return void
     */
    protected function run()
    {
        $id = $this->request->get('id');
        $conversation = $this->conversations->findById($id);

        $creator = User::current();

        $post = new Post([
            'poster'	=> $creator->username,
            'poster_id'	=> $creator->id,
            'message'	=> $this->request->get('req_message'),
            'posted'	=> Carbon::now(),
        ]);

        $this->onErrorRedirectTo(new Request('conversation', ['id' => $conversation->id]));
        $this->validator->validate($post);

        $this->conversations->addReply($conversation, $post);

        $this->trigger('user.posted', [$creator, $post]);

        $this->redirectTo(
            new Request('viewpost', ['id' => $post->id]),
            trans('fluxbb::post.post_added')
        );
    }
}
