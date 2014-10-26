<?php

namespace FluxBB\Web;

use Illuminate\Contracts\Container\Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class Dispatcher implements HttpKernelInterface
{
    /**
     * @var \FluxBB\Web\Router
     */
    protected $router;

    /**
     * @var \FluxBB\Web\ControllerFactory
     */
    protected $factory;

    /**
     * @var \Illuminate\Contracts\Container\Container
     */
    protected $container;


    /**
     * Create a dispatcher instance.
     *
     * @param \FluxBB\Web\Router $router
     * @param \FluxBB\Web\ControllerFactory $factory
     * @param \Illuminate\Contracts\Container\Container $container
     */
    public function __construct(Router $router, ControllerFactory $factory, Container $container)
    {
        $this->router = $router;
        $this->factory = $factory;
        $this->container = $container;
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request, $type = self::MASTER_REQUEST, $catch = true)
    {
        $callable = $this->getCallable($request);

        return $this->callController($callable, $request);
    }

    /**
     * Instantiate the controller and run the given action.
     *
     * @param string $callable
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function callController($callable, Request $request)
    {
        list($class, $action) = explode('@', $callable[0], 2);

        $parameters = $callable[1];
        $request->query->add($parameters);

        $controller = $this->factory->make($class);
        $controller->setRequest($request);

        return $this->container->call([$controller, $action], $parameters);
    }

    /**
     * Get the class of the controller to be executed.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return string
     */
    protected function getCallable(Request $request)
    {
        $method = $request->getMethod();
        $uri = $request->getPathInfo();

        return $this->router->getCallable($method, $uri);
    }
}
