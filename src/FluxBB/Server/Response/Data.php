<?php

namespace FluxBB\Server\Response;

use FluxBB\Server\Request;

class Data extends Response
{
    protected $data;

    protected $request;


    public function __construct(array $data, Request $request)
    {
        $this->data = $data;
        $this->request = $request;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function accept(HandlerInterface $handler)
    {
        return $handler->handleDataResponse($this);
    }
}
