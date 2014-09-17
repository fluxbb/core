<?php

namespace FluxBB\Core;

use FluxBB\Server\Exception\ValidationFailed;
use Illuminate\Validation\Factory;

class Validator
{
    /**
     * The validator factory instance.
     *
     * @var \Illuminate\Validation\Factory
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
     * @param \Illuminate\Validation\Factory $validation
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
            throw new ValidationFailed($validation->errors()->all());
        }
    }
}
