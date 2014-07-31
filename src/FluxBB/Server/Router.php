<?php

namespace FluxBB\Server;

use FastRoute\Dispatcher;
use FastRoute\RouteParser;
use FastRoute\DataGenerator;
use FastRoute\RouteCollector;

class Router
{
    /**
     * @var \FastRoute\RouteCollector
     */
    protected $routes;

    /**
     * @var \FastRoute\Dispatcher
     */
    protected $dispatcher;


    public function __construct()
    {
        $this->routes = new RouteCollector(
            new RouteParser\Std,
            new DataGenerator\GroupCountBased
        );
    }

    public function get($path, $handler)
    {
        $this->addRoute('GET', $path, $handler);
    }

    public function post($path, $handler)
    {
        $this->addRoute('POST', $path, $handler);
    }

    public function put($path, $handler)
    {
        $this->addRoute('PUT', $path, $handler);
    }

    public function delete($path, $handler)
    {
        $this->addRoute('DELETE', $path, $handler);
    }

    public function addRoute($method, $path, $handler)
    {
        $this->routes->addRoute($method, $path, $handler);
    }

    public function getRequest($method, $uri)
    {
        $routeInfo = $this->getDispatcher()->dispatch($method, $uri);
        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                throw new \Exception('404 Not Found');
                break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                throw new \Exception('405 Method Not Allowed');
                break;
            case Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $parameters = $routeInfo[2];
                return new Request($handler, $parameters);
        }
    }

    protected function getDispatcher()
    {
        if (! isset($this->dispatcher)) {
            $this->dispatcher = new Dispatcher\GroupCountBased($this->routes->getData());
        }

        return $this->dispatcher;
    }
}
