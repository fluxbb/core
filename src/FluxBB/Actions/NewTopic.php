<?php

namespace FluxBB\Actions;

use Carbon\Carbon;
use FluxBB\Actions\Exception\ValidationException;
use FluxBB\Validator\PostValidator;
use Symfony\Component\HttpFoundation\Request;
use FluxBB\Models\User;
use FluxBB\Models\Post;
use FluxBB\Models\Topic;
use FluxBB\Models\Forum;

class NewTopic extends Base
{
    protected $forum;

    protected $topic;

    protected $post;

    protected $validator;

    protected $subject;

    protected $message;


    public function __construct(PostValidator $validator)
    {
        $this->validator = $validator;
    }

    protected function handleRequest(Request $request)
    {
        $fid = \Route::input('id');

        $this->forum = Forum::with('perms')->findOrFail($fid);

        $this->subject = $request->input('req_subject');
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
        $now = Carbon::now();

        $this->topic = new Topic([
            'poster'        => $creator->username,
            'subject'       => $this->subject,
            'posted'        => $now,
            'last_post'     => $now,
            'last_poster'   => $creator->username,
            'forum_id'      => $this->forum->id,
        ]);

        $this->post = new Post([
            'poster'	=> $creator->username,
            'poster_id'	=> $creator->id,
            'message'	=> $this->message,
            'posted'	=> $now,
        ]);

        if (! $this->validator->isValid($this->post)) {
            throw new ValidationException();
        }

        $this->topic->save();
        $this->topic->addReply($this->post);
        $this->post->save();

        $this->trigger('user.posted', [$creator, $this->post]);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    protected function makeResponse()
    {
        return $this->redirectTo(route('viewtopic', ['id' => $this->topic->id]))
            ->withMessage(trans('fluxbb::topic.topic_added'));
    }

    protected function urlOnError()
    {
        return route('new_topic', ['id' => $this->forum->id]);
    }
}
