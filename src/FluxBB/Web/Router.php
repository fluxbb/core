<?php

namespace FluxBB\Web;

use FastRoute\Dispatcher;
use FastRoute\RouteParser;
use FastRoute\DataGenerator;
use FluxBB\Server\Request;

class Router
{
    /**
     * @var \FastRoute\DataGenerator
     */
    protected $dataGenerator;

    /**
     * @var \FastRoute\RouteParser
     */
    protected $routeParser;

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
        $this->routeParser = new RouteParser\Std;
        $this->dataGenerator = new DataGenerator\GroupCountBased;
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
        $routeData = $this->routeParser->parse($path);
        $this->dataGenerator->addRoute($method, $routeData, $handler);

        $routeDate['method'] = $method;
        $this->reverse[$handler] = $routeData;

        return $this;
    }

    public function getPath($handler, $parameters = [])
    {
        $parts = $this->reverse[$handler];

        $path = implode('', array_map(function ($part) use ($parameters) {
            if (is_array($part)) {
                $part = $parameters[$part[0]];
                // TODO: Verify using regex in $part[1]
            }
            return $part;
        }, $parts));

        $path = '/' . ltrim($path, '/');
        return $path;
    }

    public function getMethod($handler)
    {
        return array_get($this->reverse, $handler . '.method', '');
    }

    public function getRequest($method, $uri, $parameters)
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
                $parameters += $routeInfo[2];
                return new Request($handler, $parameters);
        }
    }

    protected function getDispatcher()
    {
        if (! isset($this->dispatcher)) {
            $this->dispatcher = new Dispatcher\GroupCountBased($this->dataGenerator->getData());
        }

        return $this->dispatcher;
    }
}
