<?php

namespace FluxBB\Actions;

use Carbon\Carbon;
use FluxBB\Core\Action;
use FluxBB\Validator\PostValidator;
use FluxBB\Server\Request;
use FluxBB\Models\User;
use FluxBB\Models\Post;
use FluxBB\Models\Topic;

class Reply extends Action
{
    protected $topic;

    protected $post;

    protected $validator;


    public function __construct(PostValidator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Run the action and return a response for the user.
     *
     * @return void
     */
    protected function run()
    {
        $tid = $this->request->get('id');
        $this->topic = Topic::with('forum.perms')->findOrFail($tid);

        $creator = User::current();

        $this->post = new Post([
            'poster'	=> $creator->username,
            'poster_id'	=> $creator->id,
            'message'	=> $this->request->get('req_message'),
            'posted'	=> Carbon::now(),
        ]);

        $this->onErrorRedirectTo(new Request('viewtopic', ['id' => $this->topic->id]));
        $this->validator->validate($this->post);

        $this->topic->addReply($this->post);
        $this->post->save();

        $this->trigger('user.posted', [$creator, $this->post]);

        $this->redirectTo(
            new Request('viewpost', ['id' => $this->post->id]),
            trans('fluxbb::post.post_added')
        );
    }
}
