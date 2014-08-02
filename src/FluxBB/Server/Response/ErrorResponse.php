<?php

namespace FluxBB\Server\Response;

class ErrorResponse extends Response
{
    public function accept(HandlerInterface $handler)
    {
        return $handler->handleErrorResponse($this);
    }
}
