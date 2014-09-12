<?php

namespace FluxBB\Server;

use Illuminate\Container\Container;

class Server
{
    /**
     * @var array
     */
    protected $actions = [];

    /**
     * @var \Illuminate\Container\Container
     */
    protected $container;


    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Register a named action.
     *
     * @param $name
     * @param $actionClass
     * @return $this
     */
    public function register($name, $actionClass)
    {
        $this->actions[$name] = $actionClass;
        return $this;
    }

    public function dispatch(Request $request)
    {
        $action = $this->resolve($request->getHandler());
        return $action->handle($request);
    }

    /**
     * Resolve an action instance by name.
     *
     * @param $name
     * @return \FluxBB\Core\Action
     * @throws \InvalidArgumentException
     */
    protected function resolve($name)
    {
        if (isset($this->actions[$name])) {
            return $this->container->make($this->actions[$name]);
        }

        throw new \InvalidArgumentException("Named action '$name' could not be found.");
    }
}
