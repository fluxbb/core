<?php

namespace FluxBB\Actions;

use FluxBB\Core\Action;
use FluxBB\Events\UserSubscribed;
use FluxBB\Models\Topic;
use FluxBB\Models\User;
use FluxBB\Server\Request;

class SubscribeTopic extends Action
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

        if (! $topic->subscribers->contains($user)) {
            $topic->subscribers()->attach($user);
            $this->raise(new UserSubscribed($topic, $user));
        }

        $this->redirectTo(
            new Request('viewtopic', ['id' => $tid]),
            'Subscription added.'
        );
    }
}
