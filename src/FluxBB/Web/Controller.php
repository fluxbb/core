<?php

namespace FluxBB\Web;

use FluxBB\Server\Request as ServerRequest;
use FluxBB\Server\ServerInterface;
use FluxBB\View\ViewInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class Controller
{
    /**
     * The server instance.
     *
     * @var \FluxBB\Server\ServerInterface
     */
    protected $server;

    /**
     * The view instance.
     *
     * @var \FluxBB\View\ViewInterface
     */
    protected $view;

    /**
     * The request being handled.
     *
     * @var \Symfony\Component\HttpFoundation\Request
     */
    protected $request;


    /**
     * Set the server to use.
     *
     * @param \FluxBB\Server\ServerInterface $server
     */
    public function setServer(ServerInterface $server)
    {
        $this->server = $server;
    }

    /**
     * Set the view environment to use.
     *
     * @param \FluxBB\View\ViewInterface $view
     */
    public function setView(ViewInterface $view)
    {
        $this->view = $view;
    }

    /**
     * Run the given action and return its response.
     *
     * @param string $action
     * @param array $parameters
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function runAction($action, array $parameters, Request $request)
    {
        $this->request = $request;
        return call_user_func_array([$this, $action], $parameters);
    }

    /**
     * Let the FluxBB server execute the given action and return its response.
     *
     * @param string $action
     * @param array $parameters
     * @return \FluxBB\Server\Response
     */
    protected function execute($action, array $parameters = [])
    {
        return $this->server->dispatch(
            new ServerRequest($action, $parameters)
        );
    }

    /**
     * Render the given view.
     *
     * @param string $name
     * @param array $data
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function view($name, array $data = [])
    {
        return new Response($this->view->render($name, $data));
    }

    /**
     * Create a redirect response.
     *
     * @param string $to
     * @param string $message
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function redirect($to, $message = null)
    {
        return new RedirectResponse($to);
    }
}
