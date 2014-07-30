<?php

namespace FluxBB\Server;

class Request
{
    protected $parameters = [];


    public function __construct($handler, array $parameters)
    {
        $this->parameters = $parameters;
    }

    public function get($name, $default = null)
    {
        return array_get($this->parameters, $name, $default);
    }
}
