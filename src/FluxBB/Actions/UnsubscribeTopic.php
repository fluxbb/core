<?php

namespace FluxBB\Actions;

use FluxBB\Models\Topic;
use FluxBB\Models\User;
use FluxBB\Server\Request;

class UnsubscribeTopic extends Base
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

        if ($topic->subscribers->contains($user->id)) {
            $topic->subscribers()->detach($user);
            $this->trigger('topic.unsubscribed', [$topic, $user]);
        }

        $this->redirectTo(
            new Request('viewtopic', ['id' => $tid]),
            'Subscription removed.'
        );
    }
}
