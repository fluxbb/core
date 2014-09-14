<?php

namespace FluxBB\Server;

class Request
{
    protected $handler;

    protected $parameters;


    public function __construct($handler, array $parameters = [])
    {
        $this->handler = $handler;
        $this->parameters = $parameters;
    }

    public function getHandler()
    {
        return $this->handler;
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    public function get($name = null, $default = null)
    {
        return array_get($this->parameters, $name, $default);
    }
}
