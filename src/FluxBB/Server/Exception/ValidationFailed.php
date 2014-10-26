<?php

namespace FluxBB\Server\Exception;

use Illuminate\Contracts\Support\MessageProvider;

class ValidationFailed extends Exception implements MessageProvider
{
    protected $errors;


    public function __construct(MessageProvider $errors)
    {
        $this->errors = $errors;
    }

    /**
     * Get the messages for the instance.
     *
     * @return \Illuminate\Support\MessageBag
     */
    public function getMessageBag()
    {
        return $this->errors->getMessageBag();
    }
}
