<?php

namespace FluxBB\Server\Response;

class RedirectResponse extends Response
{
    public function accept(HandlerInterface $handler)
    {
        return $handler->handleRedirectResponse($this);
    }
}
