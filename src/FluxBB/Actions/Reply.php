<?php

namespace FluxBB\Actions;

use Carbon\Carbon;
use FluxBB\Actions\Exception\ValidationException;
use FluxBB\Validator\PostValidator;
use Symfony\Component\HttpFoundation\Request;
use FluxBB\Models\User;
use FluxBB\Models\Post;
use FluxBB\Models\Topic;

class Reply extends Base
{
    protected $topic;

    protected $post;

    protected $validator;

    protected $message;


    public function __construct(PostValidator $validator)
    {
        $this->validator = $validator;
    }

    protected function handleRequest(Request $request)
    {
        $tid = 1; // TODO: Retrieve from request

        $this->topic = Topic::with('forum.perms')
            ->where('id', '=', $tid)
            ->first();

        if (is_null($this->topic)) {
            \App::abort(404);
        }

        $this->message = $request->input('req_message');
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
            'message'	=> $this->message,
            'posted'	=> Carbon::now(),
        ]);

        if (! $this->validator->isValid($this->post)) {
            throw new ValidationException();
        }

        $this->topic->addReply($this->post);
        $this->post->save();

        $this->trigger('user.posted', [$creator, $this->post]);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    protected function makeResponse()
    {
        return $this->redirectTo(route('viewpost', ['id' => $this->post->id]))
            ->withMessage(trans('fluxbb::post.post_added'));
    }

    protected function urlOnError()
    {
        return route('reply', ['id' => $this->topic->id, 'error' => 'ohyeah']);
    }
}
