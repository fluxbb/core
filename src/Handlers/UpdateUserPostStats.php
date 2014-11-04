<?php

namespace FluxBB\Handlers;

use FluxBB\Core\EventHandler;
use FluxBB\Events\UserHasPosted;

class UpdateUserPostStats extends EventHandler
{
    public function whenUserHasPosted(UserHasPosted $event)
    {
        $user = $event->user;
        $user->last_post = $event->time;
        $user->num_posts += 1;
        $user->save();
    }
}
