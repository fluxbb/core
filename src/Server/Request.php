<?php

namespace FluxBB\Server;

class Request
{
    /**
     * The requested handler.
     *
     * @var string
     */
    protected $handler;

    /**
     * The parameters passed with the request.
     *
     * @var array
     */
    protected $parameters;


    /**
     * Create a request instance.
     *
     * @param string $handler
     * @param array $parameters
     */
    public function __construct($handler, array $parameters = [])
    {
        $this->handler = $handler;
        $this->parameters = $parameters;
    }

    /**
     * Get the requested handler.
     *
     * @return string
     */
    public function getHandler()
    {
        return $this->handler;
    }

    /**
     * Get all of the request parameters.
     *
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * Get one or all of the request parameters.
     *
     * @param string $name
     * @param string $default
     * @return string|array
     */
    public function get($name = null, $default = null)
    {
        return array_get($this->parameters, $name, $default);
    }
}
