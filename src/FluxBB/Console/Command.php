<?php

namespace FluxBB\Console;

use FluxBB\Server\Request;
use FluxBB\Server\ServerInterface;
use Illuminate\Console\Command as LaravelCommand;

abstract class Command extends LaravelCommand
{
    /**
     * @var \FluxBB\Server\ServerInterface
     */
    protected $server;


    abstract protected function fire();

    public function setServer(ServerInterface $server)
    {
        $this->server = $server;
    }

    /**
     * Let the FluxBB server execute the given action and return its response.
     *
     * @param string $action
     * @param array $parameters
     * @return \FluxBB\Server\Response
     */
    public function dispatch($action, array $parameters = [])
    {
        return $this->server->dispatch(
            new Request($action, $parameters)
        );
    }
}
