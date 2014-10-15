<?php

namespace FluxBB\Web;

use Symfony\Component\HttpFoundation\Response;

interface ResponseHandlerInterface
{
    public function handleResponse(Response $response);
}
