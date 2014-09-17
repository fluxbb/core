<?php

namespace FluxBB\Validator;

use FluxBB\Models\Post;
use FluxBB\Server\Exception\ValidationFailed;
use Illuminate\Validation\Factory;

class PostValidator
{
    protected $validation;


    public function __construct(Factory $validation)
    {
        $this->validation = $validation;
    }

    public function validate(Post $post)
    {
        $rules = [
            'message' => 'required',
        ];

        $validation = $this->validation->make($post->getAttributes(), $rules);

        if ($validation->fails()) {
            throw new ValidationFailed($validation->errors()->all());
        }
    }
}
