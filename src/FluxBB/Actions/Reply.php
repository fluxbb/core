<?php

namespace FluxBB\Actions;

use Carbon\Carbon;
use FluxBB\Actions\Exception\ValidationException;
use FluxBB\Validator\PostValidator;
use FluxBB\Server\Request;
use FluxBB\Models\User;
use FluxBB\Models\Post;
use FluxBB\Models\Topic;

class Reply extends Base
{
    protected $topic;

    protected $post;

    protected $validator;


    public function __construct(PostValidator $validator)
    {
        $this->validator = $validator;
    }

    protected function handleRequest(Request $request)
    {
        $tid = $request->get('id');

        $this->topic = Topic::with('forum.perms')->findOrFail($tid);
    }

    /**
     * Run the action and return a response for the user.
     *
     * @throws Exception\ValidationException
     * @return void
     */
    protected function run()
    {
        $creator = User::current();

        $this->post = new Post([
            'poster'	=> $creator->username,
            'poster_id'	=> $creator->id,
            'message'	=> $this->request->get('req_message'),
            'posted'	=> Carbon::now(),
        ]);

        if (! $this->validator->isValid($this->post)) {
            throw new ValidationException();
        }

        $this->topic->addReply($this->post);
        $this->post->save();

        $this->trigger('user.posted', [$creator, $this->post]);
    }

    protected function hasRedirect()
    {
        return true;
    }

    protected function nextRequest()
    {
        return new Request('viewpost', ['id' => $this->post->id]);
        // ->withMessage(trans('fluxbb::post.post_added'));
    }

    protected function errorRequest()
    {
        return new Request('viewtopic', ['id' => $this->topic->id]);
    }
}
