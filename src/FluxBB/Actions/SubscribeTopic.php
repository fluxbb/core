<?php

namespace FluxBB\Actions;

use FluxBB\Core\Action;
use FluxBB\Events\UserSubscribed;
use FluxBB\Models\Topic;
use FluxBB\Models\User;

class SubscribeTopic extends Action
{
    protected function run()
    {
        $tid = $this->get('id');
        $topic = Topic::findOrFail($tid);
        $user = User::current();

        if (! $topic->subscribers->contains($user)) {
            $topic->subscribers()->attach($user);
            $this->raise(new UserSubscribed($topic, $user));
        }
    }
}
