<?php

namespace FluxBB\Web;

use FluxBB\Server\Request;
use FluxBB\Server\Response\Data;
use FluxBB\Server\Response\Error;
use FluxBB\Server\Response\HandlerInterface;
use FluxBB\Server\Response\Redirect;
use FluxBB\Server\Response\Response;
use Illuminate\Routing\Redirector;
use Symfony\Component\HttpFoundation\JsonResponse;

class JsonRenderer implements HandlerInterface
{
    /**
     * @var \Illuminate\Routing\Redirector
     */
    protected $redirect;

    /**
     * @var \FluxBB\Web\Router
     */
    protected $router;

    /**
     * @var \FluxBB\Server\Request
     */
    protected $request;


    public function __construct(Redirector $redirect, Router $router)
    {
        $this->redirect = $redirect;
        $this->router = $router;
    }

    public function render(Request $request, Response $response)
    {
        $this->request = $request;
        return $response->accept($this);
    }

    public function handleDataResponse(Data $response)
    {
        return new JsonResponse($response->getData(), 200);
    }

    public function handleRedirectResponse(Redirect $redirect)
    {
        $handler = $redirect->getNextRequest()->getHandler();
        $parameters = $redirect->getNextRequest()->getParameters();
        $message = $redirect->getMessage();

        $uri = $this->router->getPath($handler, $parameters);
        $response = $this->redirect->route('fluxbb', $uri);

        if ($message) {
            $response->with('message', $message);
        }

        return $response;
    }

    public function handleErrorResponse(Error $response)
    {
        return new JsonResponse($response->getErrors()->toArray(), 400);
    }
}
