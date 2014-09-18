<?php

namespace FluxBB\Web;

use FluxBB\Server\DispatcherInterface;
use FluxBB\Server\Request;
use FluxBB\Server\Response\Data;
use FluxBB\Server\Response\Error;
use FluxBB\Server\Response\HandlerInterface;
use FluxBB\Server\Response\Redirect;
use FluxBB\Server\Response\Response;
use FluxBB\Web\Router;
use Illuminate\Contracts\View\Factory;
use Illuminate\Routing\Redirector;

class Renderer implements HandlerInterface
{
    /**
     * @var \Illuminate\Contracts\View\Factory
     */
    protected $view;

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


    public function __construct(Factory $view, Redirector $redirect, Router $router)
    {
        $this->view = $view;
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
        $viewName = 'fluxbb::' . $this->request->getHandler();
        return $this->view->make($viewName, $response->getData());
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
        $redirect = $this->handleRedirectResponse($response);
        $redirect->withInput();
        $redirect->withErrors($response);
        return $redirect;
    }
}
