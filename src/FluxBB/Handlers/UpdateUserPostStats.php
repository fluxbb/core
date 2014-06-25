<?php

namespace FluxBB\Handlers;

use Carbon\Carbon;
use FluxBB\Models\User;

class UpdateUserPostStats
{
    public function handle(User $user)
    {
        $user->last_post = Carbon::now();
        $user->num_posts += 1;
        $user->save();
    }
}
