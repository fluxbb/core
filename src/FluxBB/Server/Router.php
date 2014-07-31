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
     * @var array
     */
    protected $reverse = [];

    /**
     * @var \FastRoute\Dispatcher
     */
    protected $dispatcher;


    public function __construct()
    {
        $parser = new RouteParser\Std;
        $generator = new DataGenerator\GroupCountBased;

        $this->routes = new RouteCollector($parser, $generator);
    }

    public function get($path, $handler)
    {
        return $this->addRoute('GET', $path, $handler);
    }

    public function post($path, $handler)
    {
        return $this->addRoute('POST', $path, $handler);
    }

    public function put($path, $handler)
    {
        return $this->addRoute('PUT', $path, $handler);
    }

    public function delete($path, $handler)
    {
        return $this->addRoute('DELETE', $path, $handler);
    }

    public function addRoute($method, $path, $handler)
    {
        $this->routes->addRoute($method, $path, $handler);
        $this->storeReverseRoute($handler, ['path' => $path, 'method' => $method]);

        return $this;
    }

    public function getPath($handler)
    {
        return array_get($this->reverse, $handler . '.path', '');
    }

    public function getMethod($handler)
    {
        return array_get($this->reverse, $handler . '.method', '');
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

    protected function storeReverseRoute($handler, $path)
    {
        $this->reverse[$handler] = $path;
    }

    protected function getDispatcher()
    {
        if (! isset($this->dispatcher)) {
            $this->dispatcher = new Dispatcher\GroupCountBased($this->routes->getData());
        }

        return $this->dispatcher;
    }
}
