<?php

namespace FluxBB\Core;

use FluxBB\Server\Exception\ValidationFailed;
use Illuminate\Contracts\Validation\Factory;

class Validator
{
    /**
     * The validator factory instance.
     *
     * @var \Illuminate\Contracts\Validation\Factory
     */
    protected $validation;

    /**
     * The rules to validate against.
     *
     * @var array
     */
    protected $rules = [];


    /**
     * Create a validator instance.
     *
     * @param \Illuminate\Contracts\Validation\Factory $validation
     */
    public function __construct(Factory $validation)
    {
        $this->validation = $validation;
    }

    /**
     * Make sure the given attributes comply to our rules.
     *
     * Throws an exception if validation fails.
     *
     * @param array $attributes
     * @return void
     * @throws \FluxBB\Server\Exception\ValidationFailed
     */
    protected function ensureValid(array $attributes)
    {
        $validation = $this->validation->make($attributes, $this->rules);

        if ($validation->fails()) {
            throw new ValidationFailed($validation->getMessageBag());
        }
    }
}
