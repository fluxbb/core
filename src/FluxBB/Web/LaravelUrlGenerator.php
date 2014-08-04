<?php

namespace FluxBB\Web;

use Illuminate\Routing\UrlGenerator;

class LaravelUrlGenerator
{
    /**
     * @var \FluxBB\Web\Router
     */
    protected $router;

    /**
     * @var \Illuminate\Routing\UrlGenerator
     */
    protected $generator;


    public function __construct(Router $router, UrlGenerator $generator)
    {
        $this->router = $router;
        $this->generator = $generator;
    }

    public function toRoute($handler, $parameters)
    {
        $path = $this->router->getPath($handler, $parameters);
        return $this->generator->route('fluxbb', ['url' => $path]);
    }
}
