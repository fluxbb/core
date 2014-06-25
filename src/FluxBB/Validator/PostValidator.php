<?php

namespace FluxBB\Validator;

use FluxBB\Models\Post;
use Illuminate\Validation\Factory;

class PostValidator
{
    protected $validation;


    public function __construct(Factory $validation)
    {
        $this->validation = $validation;
    }

    public function isValid(Post $post)
    {
        $rules = [
            'message'   => 'required',
        ];

        return $this->validation->make($post->getAttributes(), $rules)->passes();
    }
}
