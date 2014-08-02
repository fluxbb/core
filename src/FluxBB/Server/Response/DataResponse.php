<?php

namespace FluxBB\Server\Response;

class DataResponse extends Response
{
    protected $data;


    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

    public function accept(HandlerInterface $handler)
    {
        return $handler->handleDataResponse($this);
    }
}
