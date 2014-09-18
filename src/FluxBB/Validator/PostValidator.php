<?php

namespace FluxBB\Validator;

use FluxBB\Core\Validator;
use FluxBB\Models\Post;

class PostValidator extends Validator
{
    /**
     * Get the rules to validate against.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'message' => 'required',
        ];
    }

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
