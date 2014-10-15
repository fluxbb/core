<?php

namespace FluxBB\Actions;

use FluxBB\Core\Action;
use FluxBB\Events\UserUnsubscribed;
use FluxBB\Models\Topic;
use FluxBB\Models\User;

class UnsubscribeTopic extends Action
{
    protected function run()
    {
        $tid = $this->get('id');
        $topic = Topic::findOrFail($tid);
        $user = User::current();

        if ($topic->subscribers->contains($user->id)) {
            $topic->subscribers()->detach($user);
            $this->raise(new UserUnsubscribed($topic, $user));
        }
    }
}
