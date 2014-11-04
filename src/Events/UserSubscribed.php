<?php

namespace FluxBB\Events;

use FluxBB\Models\Topic;
use FluxBB\Models\User;

class UserSubscribed
{
    /**
     * @var \FluxBB\Models\Topic
     */
    public $topic;

    /**
     * @var \FluxBB\Models\User
     */
    public $user;


    public function __construct(Topic $topic, User $user)
    {
        $this->topic = $topic;
        $this->user = $user;
    }
}
