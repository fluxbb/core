<?php

namespace FluxBB\Server\Response;

class DataResponse extends Response
{
    public function accept(HandlerInterface $handler)
    {
        return $handler->handleDataResponse($this);
    }
}
