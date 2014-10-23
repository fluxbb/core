<?php

namespace FluxBB\Web;

use Symfony\Component\HttpFoundation\Response;

class Dispatcher
{
    /**
     * @var \FluxBB\Web\RequestResolverInterface
     */
    protected $requestResolver;

    /**
     * @var \FluxBB\Web\Router
     */
    protected $router;

    /**
     * @var \FluxBB\Web\ControllerFactory
     */
    protected $factory;

    /**
     * @var \FluxBB\Web\ResponseHandlerInterface
     */
    protected $responseHandler;


    /**
     * Create a dispatcher instance.
     *
     * @param \FluxBB\Web\RequestResolverInterface $requestResolver
     * @param \FluxBB\Web\Router $router
     * @param \FluxBB\Web\ControllerFactory $factory
     * @param \FluxBB\Web\ResponseHandlerInterface $responseHandler
     */
    public function __construct(
        RequestResolverInterface $requestResolver,
        Router $router,
        ControllerFactory $factory,
        ResponseHandlerInterface $responseHandler
    ) {
        $this->requestResolver = $requestResolver;
        $this->router = $router;
        $this->factory = $factory;
        $this->responseHandler = $responseHandler;
    }

    /**
     * Obtain a request object and dispatch it to the server.
     *
     * @return void
     */
    public function dispatch()
    {
        $callable = $this->getCallable();

        $response = $this->callController($callable);

        $this->handleResponse($response);
    }

    /**
     * Get the class of the controller to be executed.
     *
     * @return string
     */
    protected function getCallable()
    {
        $method = $this->requestResolver->getMethod();
        $uri = $this->requestResolver->getUri();
        $parameters = $this->requestResolver->getParameters();

        return $this->router->getCallable($method, $uri, $parameters);
    }

    /**
     * Instantiate the controller and run the given action.
     *
     * @param string $callable
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function callController($callable)
    {
        list($class, $action) = explode('@', $callable[0], 2);
        $parameters = $callable[1];

        $controller = $this->factory->make($class);

        return $controller->runAction($action, $parameters);
    }

    /**
     * Handle the generated response in an appropriate way.
     *
     * @param \Symfony\Component\HttpFoundation\Response $response
     * @return void
     */
    protected function handleResponse(Response $response)
    {
        $this->responseHandler->handleResponse($response);
    }
}
