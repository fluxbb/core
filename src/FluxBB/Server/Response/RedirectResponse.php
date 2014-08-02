<?php

namespace FluxBB\Server\Response;

use FluxBB\Server\Request;

class RedirectResponse extends Response
{
    protected $next;


    public function __construct(Request $next)
    {
        $this->next = $next;
    }

    public function getNextRequest()
    {
        return $this->next;
    }

    public function accept(HandlerInterface $handler)
    {
        return $handler->handleRedirectResponse($this);
    }
}
