<?php

namespace FluxBB\Server\Response;

class RedirectResponse extends Response
{
    protected $nextHandler;


    public function __construct($nextHandler)
    {
        $this->nextHandler = $nextHandler;
    }

    public function getNextHandler()
    {
        return $this->nextHandler;
    }

    public function accept(HandlerInterface $handler)
    {
        return $handler->handleRedirectResponse($this);
    }
}
