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
     * The URL generator instance.
     *
     * @var \FluxBB\Web\UrlGeneratorInterface
     */
    protected $url;

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
     * @return void
     */
    public function setServer(ServerInterface $server)
    {
        $this->server = $server;
    }

    /**
     * Set the view environment to use.
     *
     * @param \FluxBB\View\ViewInterface $view
     * @return void
     */
    public function setView(ViewInterface $view)
    {
        $this->view = $view;
    }

    /**
     * Set the URL generator instance.
     *
     * @param \FluxBB\Web\UrlGeneratorInterface $url
     * @return void
     */
    public function setUrlGenerator(UrlGeneratorInterface $url)
    {
        $this->url = $url;
    }

    /**
     * Set the request being handled.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return void
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
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
        $parameters += $this->getInput();

        return $this->server->dispatch(
            new ServerRequest($action, $parameters)
        );
    }

    /**
     * Get all input parameters that were passed to this request.
     *
     * @return array
     */
    protected function getInput()
    {
        return $this->request->request->all() + $this->request->query->all();
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
        $url = $this->url->toRoute($to);

        return new RedirectResponse($url);
    }
}
