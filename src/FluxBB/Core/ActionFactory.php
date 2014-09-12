<?php

namespace FluxBB\Core;

use Illuminate\Container\Container;

class ActionFactory
{
    /**
     * An instance of the IoC container.
     *
     * @var \Illuminate\Container\Container
     */
    protected $container;


    /**
     * Create a new action factory instance.
     *
     * @param \Illuminate\Container\Container $container
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
        $action->setEvents($this->container['events']);

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
