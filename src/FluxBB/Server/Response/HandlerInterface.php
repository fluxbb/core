<?php

namespace FluxBB\Server\Response;

interface HandlerInterface
{
    public function handle(Response $response);

    public function handleDataResponse(Data $response);

    public function handleRedirectResponse(Redirect $response);

    public function handleErrorResponse(Error $response);
}
