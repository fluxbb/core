<?php

namespace FluxBB\Server\Response;

use FluxBB\Server\Request;
use Illuminate\Contracts\Support\MessageProvider;
use Illuminate\Support\MessageBag;

class Error extends Redirect implements MessageProvider
{
    protected $errors;


    public function __construct(Request $next, MessageBag $errors)
    {
        parent::__construct($next);
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
        return $this->getErrors();
    }
}
