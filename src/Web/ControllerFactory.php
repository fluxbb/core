<?php

namespace FluxBB\Web;

use Illuminate\Contracts\Container\Container;

class ControllerFactory
{
    /**
     * The container instance.
     *
     * @var \Illuminate\Contracts\Container\Container
     */
    protected $container;


    /**
     * Create a factory instance.
     *
     * @param \Illuminate\Contracts\Container\Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Create and bootstrap the given controller class.
     *
     * @param string $class
     * @return \FluxBB\Web\Controller
     */
    public function make($class)
    {
        $controller = $this->container->make($class);
        $controller->setServer($this->makeServer());
        $controller->setView($this->makeView());
        $controller->setSession($this->makeSession());
        $controller->setUrlGenerator($this->makeUrlGenerator());

        return $controller;
    }

    /**
     * Instantiate the FluxBB server.
     *
     * @return \FluxBB\Server\ServerInterface
     */
    protected function makeServer()
    {
        return $this->container->make('FluxBB\Server\ServerInterface');
    }

    /**
     * Instantiate the view environment.
     *
     * @return \FluxBB\View\ViewInterface
     */
    protected function makeView()
    {
        return $this->container->make('FluxBB\View\ViewInterface');
    }

    /**
     * Instantiate the session driver.
     *
     * @return \Symfony\Component\HttpFoundation\Session\SessionInterface
     */
    protected function makeSession()
    {
        return $this->container->make('Symfony\Component\HttpFoundation\Session\SessionInterface');
    }

    /**
     * Instantiate the URL generator.
     *
     * @return \FluxBB\Web\UrlGeneratorInterface
     */
    protected function makeUrlGenerator()
    {
        return $this->container->make('FluxBB\Web\UrlGeneratorInterface');
    }
}
