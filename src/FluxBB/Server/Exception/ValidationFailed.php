<?php

namespace FluxBB\Server\Exception;

use Illuminate\Support\MessageBag;

class ValidationFailed extends \Exception
{
    protected $errors;


    public function __construct(array $errors)
    {
        $this->errors = $errors;
    }

    /**
     * Get all validation errors.
     *
     * @return \Illuminate\Support\MessageBag
     */
    public function getErrors()
    {
        return new MessageBag($this->errors);
    }
}
