<?php

namespace FluxBB\Server;

class Response
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
}
