<?php

namespace FluxBB\Server;

interface ResponseHandlerInterface
{
    public function handle(Request $request, Response $response);
}
