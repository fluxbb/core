<?php

namespace FluxBB\Events;

use FluxBB\Models\User;

class UserHasRegistered
{
    /**
     * @var \FluxBB\Models\User
     */
    public $user;


    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
