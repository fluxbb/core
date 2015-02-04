<?php

namespace FluxBB\Web;

use Illuminate\Contracts\Foundation\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class Dispatcher implements HttpKernelInterface
{
    /**
     * @var \Illuminate\Contracts\Foundation\Application;
     */
    protected $app;

    /**
     * @var \FluxBB\Web\Router
     */
    protected $router;

    /**
     * @var \FluxBB\Web\ControllerFactory
     */
    protected $factory;


    /**
     * Create a dispatcher instance.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     * @param \FluxBB\Web\Router $router
     * @param \FluxBB\Web\ControllerFactory $factory
     */
    public function __construct(Application $app, Router $router, ControllerFactory $factory)
    {
        $this->app = $app;
        $this->router = $router;
        $this->factory = $factory;
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request, $type = self::MASTER_REQUEST, $catch = true)
    {
        $this->app->boot();

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

        // Make sure any route parts are available as query parameters from the request.
        $request->query->add($callable[1]);

        $controller = $this->factory->make($class);
        $controller->setRequest($request);

        return $controller->call($action);
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
