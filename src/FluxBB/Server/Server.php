<?php

namespace FluxBB\Server;

use FluxBB\Core\Action;
use FluxBB\Core\ActionFactory;
use FluxBB\Models\HasPermissions;

class Server
{
    /**
     * The handler classes for all registered actions.
     *
     * @var array
     */
    protected $actions = [];

    /**
     * The action factory instance.
     *
     * @var \FluxBB\Core\ActionFactory
     */
    protected $factory;


    /**
     * Create a new server instance.
     *
     * @param \FluxBB\Core\ActionFactory $factory
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
     * @param \FluxBB\Models\HasPermissions $subject
     * @return \FluxBB\Server\Response\Response
     * @throws \Exception
     */
    public function dispatch(Request $request, HasPermissions $subject)
    {
        // Create the action instance
        $action = $this->resolve($request->getHandler());

        // Make sure that we are authorized for this request
        $this->ensureAuthorization($action, $request, $subject);

        return $action->handle($request);
    }

    /**
     * Throw an exception in case we are not authorized to execute this action.
     *
     * @param \FluxBB\Core\Action $action
     * @param \FluxBB\Server\Request $request
     * @param \FluxBB\Models\HasPermissions $subject
     * @return void
     * @throws \Exception
     */
    protected function ensureAuthorization(Action $action, Request $request, HasPermissions $subject)
    {
        if (!$action->authorize($request, $subject)) {
            throw new \Exception('Too bad, we are not authorized.');
        }
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
