<?php

namespace FluxBB\Server\Exception;

use Illuminate\Contracts\Support\MessageProvider;

class ValidationFailed extends Exception
{
    protected $errors;


    public function __construct(MessageProvider $errors)
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
        return $this->errors->getMessageBag();
    }
}
