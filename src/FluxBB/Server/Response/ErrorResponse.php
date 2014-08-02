<?php

namespace FluxBB\Server\Response;

use Illuminate\Support\Contracts\MessageProviderInterface;
use Illuminate\Support\MessageBag;

class ErrorResponse extends Response implements MessageProviderInterface
{
    protected $errors;


    public function __construct(MessageBag $errors)
    {
        $this->errors = $errors;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function accept(HandlerInterface $handler)
    {
        return $handler->handleErrorResponse($this);
    }

    /**
     * Get the messages for the instance.
     *
     * @return \Illuminate\Support\MessageBag
     */
    public function getMessageBag()
    {
        $this->getErrors();
    }
}
