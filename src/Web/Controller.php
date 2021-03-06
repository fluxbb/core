<?php

namespace FluxBB\Web;

use FluxBB\Server\Request as ServerRequest;
use FluxBB\Server\ServerInterface;
use FluxBB\View\ViewInterface;
use Illuminate\Session\Store;
use Symfony\Component\HttpFoundation\Request;
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
     * The session instance.
     *
     * @var \Illuminate\Session\Store
     */
    protected $session;

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
     * The consolidated input data from the request.
     *
     * @var array
     */
    protected $input;


    /**
     * Call the given action on this controller.
     *
     * @param string $action
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function call($action)
    {
        return $this->{$action}();
    }

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
     * Set the session driver to use.
     *
     * @param \Illuminate\Session\Store $session
     * @return void
     */
    public function setSession(Store $session)
    {
        $this->session = $session;
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

        $this->input = $request->request->all() + $request->query->all();
    }

    /**
     * Let the FluxBB server execute the given action and return its response data.
     *
     * @param string $action
     * @param array $parameters
     * @return array
     */
    protected function execute($action, array $parameters = [])
    {
        $parameters += $this->input;

        return $this->server->dispatch(
            new ServerRequest($action, $parameters)
        )->getData();
    }

    /**
     * Explicitly set an input parameter to the given value.
     *
     * @param string $key
     * @param string $value
     * @return void
     */
    protected function setInput($key, $value)
    {
        $this->input[$key] = $value;
    }

    /**
     * Get the value of the input parameter with the given name.
     *
     * @param string $key
     * @return string
     */
    protected function getInput($key)
    {
        return array_get($this->input, $key);
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
     * @param string $route
     * @param array $parameters
     * @return \FluxBB\Web\RedirectResponse
     */
    protected function redirectTo($route, array $parameters = [])
    {
        $url = $this->url->toRoute($route, $parameters);

        return $this->makeRedirect($url);
    }

    /**
     * Instantiate a redirect response.
     *
     * @param string $url
     * @return \FluxBB\Web\RedirectResponse
     */
    protected function makeRedirect($url)
    {
        $redirect = new RedirectResponse($url);
        $redirect->setSession($this->session);
        $redirect->setInput($this->input);

        return $redirect;
    }
}
