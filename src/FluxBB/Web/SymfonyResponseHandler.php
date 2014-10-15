<?php

namespace FluxBB\Web;

use Symfony\Component\HttpFoundation\Response;

class SymfonyResponseHandler implements ResponseHandlerInterface
{
    /**
     * @var \Symfony\Component\HttpFoundation\Response
     */
    protected $response;


    public function handleResponse(Response $response)
    {
        $this->response = $response;
    }

    /**
     * Get the Symfony response object.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getResponse()
    {
        return $this->response;
    }
}
