<?php

namespace FluxBB\Web;

use Symfony\Component\HttpFoundation\Response;

class SymfonyResponseHandler implements ResponseHandlerInterface
{
    /**
     * @var string
     */
    protected $output;


    public function handleResponse($response)
    {
        $this->output = $response;
    }

    /**
     * Get the Symfony response object.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getResponse()
    {
        return new Response($this->output);
    }
}
