<?php

namespace FluxBB\Server;

use FluxBB\Core\ActionFactory;

class Server
{
    /**
     * @var array
     */
    protected $actions = [];

    /**
     * @var \FluxBB\Core\ActionFactory
     */
    protected $factory;


    /**
     * Create a new server instance.
     *
     * @param ActionFactory $factory
     */
    public function __construct(ActionFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Register a named action and its handler class.
     *
     * @param string $name
     * @param string $actionClass
     * @return $this
     */
    public function register($name, $actionClass)
    {
        $this->actions[$name] = $actionClass;
        return $this;
    }

    /**
     * Resolve the request and return a response.
     *
     * @param \FluxBB\Server\Request $request
     * @return \FluxBB\Server\Response\Response
     */
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
            return $this->factory->make($this->actions[$name]);
        }

        throw new \InvalidArgumentException("Named action '$name' could not be found.");
    }
}
