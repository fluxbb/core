<?php

namespace FluxBB\Server\Response;

interface HandlerInterface
{
    public function handle(Response $respose);

    public function handleDataResponse(DataResponse $response);

    public function handleRedirectResponse(RedirectResponse $response);

    public function handleErrorResponse(ErrorResponse $response);
}
