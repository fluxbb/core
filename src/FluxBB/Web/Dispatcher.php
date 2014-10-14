<?php

namespace FluxBB\Web;

use FluxBB\Server\Request;
use FluxBB\Server\Response;
use FluxBB\Server\ResponseHandlerInterface;
use FluxBB\Server\ServerInterface;

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
     * @var \FluxBB\Server\ServerInterface
     */
    protected $server;

    /**
     * @var \FluxBB\Server\Response\ResponseHandlerInterface
     */
    protected $responseHandler;


    /**
     * Create a dispatcher instance.
     *
     * @param \FluxBB\Web\RequestResolverInterface $requestResolver
     * @param \FluxBB\Web\Router $router
     * @param \FluxBB\Server\ServerInterface $server
     * @param \FluxBB\Server\Response\ResponseHandlerInterface $responseHandler
     */
    public function __construct(
        RequestResolverInterface $requestResolver,
        Router $router,
        ServerInterface $server,
        ResponseHandlerInterface $responseHandler
    ) {
        $this->requestResolver = $requestResolver;
        $this->router = $router;
        $this->server = $server;
        $this->responseHandler = $responseHandler;
    }

    /**
     * Obtain a request object and dispatch it to the server.
     *
     * @return void
     */
    public function dispatch()
    {
        $request = $this->resolveRequest();

        $response = $this->server->dispatch($request);

        $this->handleResponse($request, $response);
    }

    /**
     * Resolve an internal request object to be sent to the FluxBB server.
     *
     * @return \FluxBB\Server\Request
     */
    protected function resolveRequest()
    {
        $method = $this->requestResolver->getMethod();
        $uri = $this->requestResolver->getUri();
        $parameters = $this->requestResolver->getParameters();

        return $this->router->getRequest($method, $uri, $parameters);
    }

    /**
     * Handle the generated response in an appropriate way.
     *
     * @param \FluxBB\Server\Request $request
     * @param \FluxBB\Server\Response $response
     * @return void
     */
    protected function handleResponse(Request $request, Response $response)
    {
        $this->responseHandler->handle($request, $response);
    }
}
