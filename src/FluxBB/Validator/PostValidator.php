<?php

namespace FluxBB\Validator;

use FluxBB\Core\Validator;
use FluxBB\Models\Post;

class PostValidator extends Validator
{
    protected $rules = [
        'message' => 'required',
    ];


    public function validate(Post $post)
    {
        $this->ensureValid($post->getAttributes());
    }
}
