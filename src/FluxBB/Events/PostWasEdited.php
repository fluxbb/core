<?php

namespace FluxBB\Events;

use FluxBB\Models\Post;
use FluxBB\Models\User;

class PostWasEdited
{
    /**
     * @var \FluxBB\Models\Post
     */
    public $post;

    /**
     * @var \FluxBB\Models\User
     */
    public $user;


    public function __construct(Post $post, User $user)
    {
        $this->post = $post;
        $this->user = $user;
    }
} 
