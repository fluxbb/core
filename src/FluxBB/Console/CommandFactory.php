<?php

namespace FluxBB\Console;

use Illuminate\Contracts\Container\Container;

class CommandFactory
{
    /**
     * The container instance.
     *
     * @var \Illuminate\Contracts\Container\Container
     */
    protected $container;


    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function make($class)
    {
        $command = $this->container->make($class);
        $command->setServer($this->container->make('FluxBB\Server\ServerInterface'));

        return $command;
    }
}
