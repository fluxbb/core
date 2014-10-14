<?php

namespace FluxBB\Web;

use FluxBB\Server\Request;
use FluxBB\Server\ServerInterface;
use FluxBB\View\ViewInterface;

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
     * Let the FluxBB server execute the given action and return its response.
     *
     * @param string $action
     * @param array $parameters
     * @return \FluxBB\Server\Response\Response
     */
    protected function execute($action, array $parameters = [])
    {
        return $this->server->dispatch(
            new Request($action, $parameters)
        );
    }

    /**
     * Render the given view.
     *
     * @param string $name
     * @return string
     */
    protected function view($name)
    {
        return $this->view->render($name);
    }
}