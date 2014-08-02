<?php

namespace FluxBB\Server\Response;

abstract class Response
{
    abstract public function accept(HandlerInterface $handler);
}
