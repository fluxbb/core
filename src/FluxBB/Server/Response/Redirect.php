<?php

namespace FluxBB\Server\Response;

use FluxBB\Server\Request;

class Redirect extends Response
{
    protected $next;

    protected $message;


    public function __construct(Request $next, $message = '')
    {
        $this->next = $next;
        $this->message = $message;
    }

    public function getNextRequest()
    {
        return $this->next;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function accept(HandlerInterface $handler)
    {
        return $handler->handleRedirectResponse($this);
    }
}
