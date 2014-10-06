<?php

namespace FluxBB\Events;

use Carbon\Carbon;
use FluxBB\Models\Post;
use FluxBB\Models\User;

class UserHasPosted
{
    /**
     * @var \FluxBB\Models\User
     */
    public $user;

    /**
     * @var \FluxBB\Models\Post
     */
    public $post;

    /**
     * @var \Carbon\Carbon
     */
    public $time;


    public function __construct(User $user, Post $post)
    {
        $this->user = $user;
        $this->post = $post;
        $this->time = Carbon::now();
    }
}
