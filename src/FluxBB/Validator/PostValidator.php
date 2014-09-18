<?php

namespace FluxBB\Validator;

use FluxBB\Core\Validator;
use FluxBB\Models\Post;

class PostValidator extends Validator
{
    /**
     * The rules to validate against.
     *
     * @var array
     */
    protected $rules = [
        'message' => 'required',
    ];


    /**
     * Make sure the given post is valid.
     *
     * @param \FluxBB\Models\Post $post
     * @throws \FluxBB\Server\Exception\ValidationFailed
     */
    public function validate(Post $post)
    {
        $this->ensureValid($post->getAttributes());
    }
}
