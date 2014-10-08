<?php

namespace FluxBB\Core;

use FluxBB\Server\Exception\ValidationFailed;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Support\MessageBag;

abstract class Validator
{
    /**
     * The validator factory instance.
     *
     * @var \Illuminate\Contracts\Validation\Factory
     */
    protected $validation;


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
     * Get the rules to validate against.
     *
     * @return array
     */
    abstract protected function rules();

    /**
     * Make sure the given attributes comply to our rules.
     *
     * Throws an exception if validation fails.
     *
     * @param array $attributes
     * @return $this
     * @throws \FluxBB\Server\Exception\ValidationFailed
     */
    protected function ensureValid(array $attributes)
    {
        $validation = $this->validation->make($attributes, $this->rules());

        if ($validation->fails()) {
            throw new ValidationFailed($validation->getMessageBag());
        }

        return $this;
    }

    /**
     * Make sure all of the keys of the given array exist in our ruleset.
     *
     * @param array $data
     * @return $this
     * @throws \FluxBB\Server\Exception\ValidationFailed
     */
    protected function ensureAllInRules(array $data)
    {
        $rules = $this->rules();

        $invalid = array_diff_key($data, $rules);

        if (!empty($invalid)) {
            throw new ValidationFailed(new MessageBag([
                'Invalid keys found in request.',
            ]));
        }

        return $this;
    }
}
