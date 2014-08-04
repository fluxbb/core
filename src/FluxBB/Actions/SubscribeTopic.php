<?php

namespace FluxBB\Actions;

use FluxBB\Models\Topic;
use FluxBB\Models\User;
use FluxBB\Server\Request;

class SubscribeTopic extends Base
{
    /**
     * Run any desired actions.
     *
     * @return void
     */
    protected function run()
    {
        $tid = $this->request->get('id');
        $topic = Topic::findOrFail($tid);
        $user = User::current();

        $topic->subscribers()->attach($user);

        $this->trigger('topic.subscribed', [$topic, $user]);

        $this->redirectTo(new Request('viewtopic', ['id' => $tid]));
    }
} 
