<?php

namespace FluxBB\Actions;

use Carbon\Carbon;
use FluxBB\Core\Action;
use FluxBB\Validator\PostValidator;
use FluxBB\Server\Request;
use FluxBB\Models\User;
use FluxBB\Models\Post;
use FluxBB\Models\Topic;
use FluxBB\Models\Forum;

class NewTopic extends Action
{
    protected $forum;

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
        $fid = $this->request->get('id');
        $this->forum = Forum::findOrFail($fid);

        $creator = User::current();
        $now = Carbon::now();

        $this->topic = new Topic([
            'poster'        => $creator->username,
            'subject'       => $this->request->get('subject'),
            'posted'        => $now,
            'last_post'     => $now,
            'last_poster'   => $creator->username,
            'forum_id'      => $this->forum->id,
        ]);

        $this->post = new Post([
            'poster'	=> $creator->username,
            'poster_id'	=> $creator->id,
            'message'	=> $this->request->get('message'),
            'posted'	=> $now,
        ]);

        $this->onErrorRedirectTo(new Request('new_topic', ['id' => $this->forum->id]));
        $this->validator->validate($this->post);

        $this->topic->save();
        $this->topic->addReply($this->post);
        $this->post->save();

        $this->trigger('user.posted', [$creator, $this->post]);

        $this->redirectTo(
            new Request('viewtopic', ['id' => $this->topic->id]),
            trans('fluxbb::topic.topic_added')
        );
    }
}
