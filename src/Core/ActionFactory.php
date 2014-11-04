<?php

namespace FluxBB\Core;

use Illuminate\Contracts\Container\Container;

class ActionFactory
{
    /**
     * An instance of the IoC container.
     *
     * @var \Illuminate\Contracts\Container\Container
     */
    protected $container;


    /**
     * Create a new action factory instance.
     *
     * @param \Illuminate\Contracts\Container\Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Create a new action instance.
     *
     * @param string $class
     * @return \FluxBB\Core\Action
     */
    public function make($class)
    {
        $action = $this->container->make($class);
        $action->setEvents($this->container->make('events'));

        return $action;
    }

    /**
     * Resolve an action from the container.
     *
     * @param string $class
     * @return \FluxBB\Core\Action
     */
    protected function resolve($class)
    {
        return $this->container->make($class);
    }
}
